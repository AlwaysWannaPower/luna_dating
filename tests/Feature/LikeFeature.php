<?php

use App\Models\Like;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can visit my likes page', function () {
    $response = $this->get(route('likes.index'));

    $response->assertOk();
    $response->assertViewIs('likes.index');
});

it('shows empty state when no likes exist', function () {
    $response = $this->get(route('likes.index'));

    $response->assertOk();
    $response->assertSee('Вы ещё не ставили лайки');
});

it('displays sent likes on my likes page', function () {
    $otherUser = User::factory()->create();
    $likedUser = User::factory()->create();

    Like::create([
        'from_user_id' => auth()->id(),
        'to_user_id' => $otherUser->id,
    ]);

    Like::create([
        'from_user_id' => auth()->id(),
        'to_user_id' => $likedUser->id,
    ]);

    $response = $this->get(route('likes.index'));

    $response->assertOk();
    $response->assertSee($otherUser->name);
    $response->assertSee($likedUser->name);
});

it('can send a like to another user', function () {
    $target = User::factory()->create();

    $response = $this->post(route('likes.store', $target));

    $response->assertRedirect();
    expect(auth()->user()->likesSent)->toHaveCount(1);
    assert(Like::where('from_user_id', auth()->id())
        ->where('to_user_id', $target->id)->exists());
});

it('does not allow liking yourself', function () {
    $me = auth()->user();

    $response = $this->post(route('likes.store', $me));

    $response->assertRedirect();
    expect(Like::where('from_user_id', $me->id)->count())->toBe(0);
});

it('does not allow double liking the same user', function () {
    $target = User::factory()->create();

    $this->post(route('likes.store', $target));
    $this->post(route('likes.store', $target));

    expect(Like::where('from_user_id', auth()->id())
        ->where('to_user_id', $target->id)->count())->toBe(1);
});

it('can remove its own like', function () {
    $target = User::factory()->create();
    $like = Like::create([
        'from_user_id' => auth()->id(),
        'to_user_id' => $target->id,
    ]);

    $response = $this->delete(route('likes.destroy', $like));

    $response->assertRedirect();
    expect(Like::find($like->id))->toBeNull();
});

it('cannot remove another user\'s like', function () {
    $creator = User::factory()->create(); // пользователь-создатель лайка
    $target = User::factory()->create(); // кто лайкнул (объект лайка)

    // Создаём лайк от создателя к цели
    $like = Like::create([
        'from_user_id' => $creator->id,
        'to_user_id' => $target->id,
    ]);

    // Логинимся как ЧужойПользователь, который НЕ является создателем
    $trespasser = User::factory()->create();
    $response = $this->actingAs($trespasser)
        ->delete(route('likes.destroy', $like));

    // Лайк должен остаться
    expect(Like::find($like->id))->not->toBeNull();
    expect(Like::count())->toBe(1);
});
