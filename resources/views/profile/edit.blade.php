<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Header -->
            <div class="text-center space-y-2">
                <h1 class="text-3xl font-bold text-text-primary dark:text-dark-text">Мой профиль</h1>
                <p class="text-text-secondary dark:text-dark-text-muted">Расскажи о себе — это поможет найти совпадения</p>
            </div>

            <!-- Profile Card -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Avatar & Basic Info -->
                <div class="bg-bg-primary dark:bg-dark-bg-card rounded-3xl p-8 border border-border dark:border-dark-border shadow-sm">
                    <div class="flex flex-col sm:flex-row items-center gap-6 mb-8">
                        <!-- Avatar Preview -->
                        <div class="relative group">
                            <div id="avatar-preview" class="w-28 h-28 rounded-full bg-gradient-to-br from-luna-primary/20 to-luna-accent/20 flex items-center justify-center text-4xl font-bold text-luna-primary overflow-hidden ring-4 ring-white dark:ring-dark-bg shadow-lg">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="avatar" class="w-full h-full object-cover">
                                @else
                                    <span id="avatar-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <label for="avatar" class="absolute bottom-0 right-0 w-9 h-9 bg-luna-primary hover:bg-luna-accent text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg transition-all duration-200 hover:scale-110">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </label>
                            <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/jpg,image/png,image/webp" class="hidden" onchange="previewAvatar(this)">
                        </div>

                        <!-- Name -->
                        <div class="flex-1 w-full">
                            <x-input-label for="name" :value="__('Имя')" class="mb-2" />
                            <x-text-input id="name" name="name" type="text" class="w-full" :value="old('name', $user->name)" required autofocus placeholder="Как тебя зовут?" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="border-border dark:border-dark-border mb-8">

                    <!-- Birth Date & Gender -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="birth_date" :value="__('Дата рождения')" />
                            <x-text-input id="birth_date" name="birth_date" type="date" class="w-full mt-1" :value="old('birth_date', $user->birth_date?->format('Y-m-d'))" />
                            <p class="text-xs text-text-secondary dark:text-dark-text-muted mt-1">Тебе должно быть не менее 16 лет</p>
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="gender" :value="__('Пол')" />
                            <select id="gender" name="gender" class="w-full mt-1 rounded-xl border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary">
                                <option value="">Не выбран</option>
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Мужчина</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Женщина</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                    </div>

                    <!-- City -->
                    <div class="mb-6">
                        <x-input-label for="city" :value="__('Город')" />
                        <x-text-input id="city" name="city" type="text" class="w-full mt-1" :value="old('city', $user->city)" placeholder="Например, Москва" />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <!-- Bio -->
                    <div class="mb-6">
                        <x-input-label for="bio" :value="__('О себе')" />
                        <textarea id="bio" name="bio" rows="4" class="w-full mt-1 rounded-xl border-border dark:border-dark-border bg-bg-primary dark:bg-dark-bg text-text-primary dark:text-dark-text focus:ring-luna-primary focus:border-luna-primary resize-none" placeholder="Расскажи о своих интересах, хобби...">{{ old('bio', $user->bio) }}</textarea>
                        <p class="text-xs text-text-secondary dark:text-dark-text-muted mt-1 max-w-md">{{ strlen(old('bio', $user->bio)) }}/1000 символов</p>
                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                    </div>

                    <!-- Looking For -->
                    <div>
                        <x-input-label for="looking_for" :value="__('Кого ищу')" />
                        <div class="flex gap-3 mt-2">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="looking_for" value="female" class="hidden peer" {{ old('looking_for', $user->looking_for) == 'female' ? 'checked' : '' }}>
                                <div class="peer-checked:bg-luna-primary peer-checked:text-white peer-checked:ring-luna-primary rounded-xl p-4 border border-border dark:border-dark-border transition-all duration-200 text-center hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover">
                                    <svg class="w-6 h-6 mx-auto mb-2 text-pink-500 peer-checked:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Девушек</span>
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="looking_for" value="male" class="hidden peer" {{ old('looking_for', $user->looking_for) == 'male' ? 'checked' : '' }}>
                                <div class="peer-checked:bg-luna-primary peer-checked:text-white peer-checked:ring-luna-primary rounded-xl p-4 border border-border dark:border-dark-border transition-all duration-200 text-center hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover">
                                    <svg class="w-6 h-6 mx-auto mb-2 text-blue-500 peer-checked:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Парней</span>
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="looking_for" value="both" class="hidden peer" {{ old('looking_for', $user->looking_for) == 'both' ? 'checked' : '' }}>
                                <div class="peer-checked:bg-luna-primary peer-checked:text-white peer-checked:ring-luna-primary rounded-xl p-4 border border-border dark:border-dark-border transition-all duration-200 text-center hover:bg-bg-tertiary dark:hover:bg-dark-bg-hover">
                                    <svg class="w-6 h-6 mx-auto mb-2 text-purple-500 peer-checked:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/>
                                    </svg>
                                    <span class="text-sm font-medium">Всех</span>
                                </div>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('looking_for')" class="mt-2" />
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-luna-primary hover:bg-luna-accent text-white font-semibold rounded-xl shadow-lg shadow-luna-primary/25 hover:shadow-luna-accent/40 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                        Сохранить изменения
                    </button>
                </div>
            </form>

            <hr class="border-border dark:border-dark-border">

            <!-- Delete Account -->
            <div class="bg-bg-primary dark:bg-dark-bg-card rounded-3xl p-8 border border-red-200 dark:border-red-900/50">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 dark:bg-red-900/20 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-1">Удалить аккаунт</h3>
                        <p class="text-sm text-text-secondary dark:text-dark-text-muted mb-4">После удаления все данные будут безвозвратно удалены.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('delete-account-form').requestSubmit()" class="px-4 py-2 text-sm font-medium text-red-600 dark:text-red-400 border border-red-300 dark:border-red-800 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        Удалить
                    </button>
                </div>
            </div>

            <form id="delete-account-form" action="{{ route('profile.destroy') }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</x-app-layout>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            preview.innerHTML = '<img src="' + e.target.result + '" alt="avatar" class="w-full h-full object-cover">';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
