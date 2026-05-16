@php
  $pageLang = $pageLang ?? app()->getLocale();
  $pageLang = in_array($pageLang, ['kk', 'ru', 'en'], true) ? $pageLang : 'ru';
  $activePage = $activePage ?? '';
  $isAuthenticated = (bool) session('library.user');

  $copy = [
    'ru' => [
      'links' => [
        ['key' => 'home', 'label' => 'Главная', 'href' => '/'],
        ['key' => 'catalog', 'label' => 'Каталог', 'href' => '/catalog'],
        ['key' => 'resources', 'label' => 'Ресурсы', 'href' => '/resources'],
        ['key' => 'news', 'label' => 'Новости', 'href' => '/news'],
        ['key' => 'events', 'label' => 'События', 'href' => '/events'],
      ],
      'guest' => 'Войти',
      'dashboard' => 'Кабинет',
      'logout' => 'Выйти',
      'lang_aria' => 'Переключатель языка',
    ],
    'kk' => [
      'links' => [
        ['key' => 'home', 'label' => 'Басты бет', 'href' => '/'],
        ['key' => 'catalog', 'label' => 'Каталог', 'href' => '/catalog'],
        ['key' => 'resources', 'label' => 'Ресурстар', 'href' => '/resources'],
        ['key' => 'news', 'label' => 'Жаңалықтар', 'href' => '/news'],
        ['key' => 'events', 'label' => 'Іс-шаралар', 'href' => '/events'],
      ],
      'guest' => 'Кіру',
      'dashboard' => 'Кабинет',
      'logout' => 'Шығу',
      'lang_aria' => 'Тіл ауыстырғыш',
    ],
    'en' => [
      'links' => [
        ['key' => 'home', 'label' => 'Home', 'href' => '/'],
        ['key' => 'catalog', 'label' => 'Catalog', 'href' => '/catalog'],
        ['key' => 'resources', 'label' => 'Resources', 'href' => '/resources'],
        ['key' => 'news', 'label' => 'News', 'href' => '/news'],
        ['key' => 'events', 'label' => 'Events', 'href' => '/events'],
      ],
      'guest' => 'Sign in',
      'dashboard' => 'Dashboard',
      'logout' => 'Sign out',
      'lang_aria' => 'Language switcher',
    ],
  ][$pageLang];

  $routeWithLang = static function (string $path, array $query = []) use ($pageLang): string {
      $normalizedPath = '/' . ltrim($path, '/');
      if ($normalizedPath === '//') {
          $normalizedPath = '/';
      }
      if ($pageLang !== 'ru') {
          $query['lang'] = $pageLang;
      }
      $query = array_filter($query, static fn ($value) => $value !== null && $value !== '');
      return $normalizedPath . ($query ? ('?' . http_build_query($query)) : '');
  };

  $localeLabels = ['kk' => 'KK', 'ru' => 'RU', 'en' => 'EN'];
@endphp

<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
  <nav class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6" aria-label="{{ __('ui.aria.main_navigation') }}">
    <a href="{{ $routeWithLang('/') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-900" aria-label="{{ __('ui.brand.home_aria') }}">
      <img src="{{ asset('logo.png') }}" alt="{{ __('ui.brand.title') }} logo" class="h-7 w-7" loading="eager" decoding="async">
      <span>{{ __('ui.brand.title') }}</span>
    </a>

    <div class="hidden items-center gap-4 md:flex">
      @foreach($copy['links'] as $item)
        <a href="{{ $routeWithLang($item['href']) }}" class="text-sm {{ $activePage === $item['key'] ? 'font-semibold text-teal-700' : 'text-slate-700 hover:text-teal-700' }}">{{ $item['label'] }}</a>
      @endforeach
    </div>

    <div class="flex items-center gap-3">
      <div class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-1 py-0.5 text-xs" role="group" aria-label="{{ $copy['lang_aria'] }}">
        @foreach(['kk', 'ru', 'en'] as $locale)
          <a href="{{ request()->fullUrlWithQuery(['lang' => $locale]) }}" class="rounded-full px-2 py-0.5 {{ $pageLang === $locale ? 'bg-teal-600 text-white' : 'text-slate-700 hover:text-teal-700' }}">{{ $localeLabels[$locale] }}</a>
        @endforeach
      </div>
      @if($isAuthenticated)
        <a href="{{ $routeWithLang('/dashboard') }}" class="text-sm font-semibold text-teal-700">{{ $copy['dashboard'] }}</a>
        <button type="button" id="shared-logout-btn" class="text-sm text-slate-700 hover:text-teal-700">{{ $copy['logout'] }}</button>
      @else
        <a href="{{ $routeWithLang('/login') }}" class="text-sm font-semibold text-teal-700">{{ $copy['guest'] }}</a>
      @endif
    </div>
  </nav>
</header>
