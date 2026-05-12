@php
  $pageLang = $pageLang ?? app()->getLocale();
  $pageLang = in_array($pageLang, ['kk', 'ru', 'en'], true) ? $pageLang : 'ru';
  $routeWithLang = static function (string $path, array $query = []) use ($pageLang): string {
      $normalizedPath = '/' . ltrim($path, '/');
      if ($normalizedPath === '//') {
          $normalizedPath = '/';
      }

      if ($pageLang !== 'ru' && ! array_key_exists('lang', $query)) {
          $query['lang'] = $pageLang;
      }

      $query = array_filter($query, static fn ($value) => $value !== null && $value !== '');

      return $normalizedPath . ($query ? ('?' . http_build_query($query)) : '');
  };

  $isAuthenticated = (bool) session('library.user');
  $copy = [
      'ru' => [
          'links' => [
              ['key' => 'catalog',   'label' => 'Каталог',   'href' => $routeWithLang('/catalog')],
              ['key' => 'discover',  'label' => 'Открытия',  'href' => $routeWithLang('/discover')],
              ['key' => 'resources', 'label' => 'Ресурсы',   'href' => $routeWithLang('/resources')],
              ['key' => 'news',      'label' => 'Новости',   'href' => $routeWithLang('/news')],
              ['key' => 'events',    'label' => 'События',   'href' => $routeWithLang('/events')],
          ],
          'institution' => [
              'label' => 'Об институте',
              'aria'  => 'Раздел «Об институте»',
              'items' => [
                  ['key' => 'about',      'label' => 'О библиотеке',     'href' => $routeWithLang('/about')],
                  ['key' => 'leadership', 'label' => 'Руководство',      'href' => $routeWithLang('/leadership')],
                  ['key' => 'rules',      'label' => 'Правила',          'href' => $routeWithLang('/rules')],
                  ['key' => 'contacts',   'label' => 'Контакты',         'href' => $routeWithLang('/contacts')],
              ],
          ],
          'guest'        => 'Войти',
          'logout'       => 'Выйти',
          'dashboard'    => 'Кабинет',
          'lang_aria'    => 'Переключатель языка',
      ],
      'kk' => [
          'links' => [
              ['key' => 'catalog',   'label' => 'Каталог',   'href' => $routeWithLang('/catalog')],
              ['key' => 'discover',  'label' => 'Ашылымдар', 'href' => $routeWithLang('/discover')],
              ['key' => 'resources', 'label' => 'Ресурстар', 'href' => $routeWithLang('/resources')],
              ['key' => 'news',      'label' => 'Жаңалықтар','href' => $routeWithLang('/news')],
              ['key' => 'events',    'label' => 'Іс-шаралар','href' => $routeWithLang('/events')],
          ],
          'institution' => [
              'label' => 'Институт туралы',
              'aria'  => '«Институт туралы» бөлімі',
              'items' => [
                  ['key' => 'about',      'label' => 'Кітапхана туралы', 'href' => $routeWithLang('/about')],
                  ['key' => 'leadership', 'label' => 'Басшылық',         'href' => $routeWithLang('/leadership')],
                  ['key' => 'rules',      'label' => 'Ережелер',         'href' => $routeWithLang('/rules')],
                  ['key' => 'contacts',   'label' => 'Байланыс',         'href' => $routeWithLang('/contacts')],
              ],
          ],
          'guest'        => 'Кіру',
          'logout'       => 'Шығу',
          'dashboard'    => 'Кабинет',
          'lang_aria'    => 'Тіл ауыстырғыш',
      ],
      'en' => [
          'links' => [
              ['key' => 'catalog',   'label' => 'Catalog',   'href' => $routeWithLang('/catalog')],
              ['key' => 'discover',  'label' => 'Discover',  'href' => $routeWithLang('/discover')],
              ['key' => 'resources', 'label' => 'Resources', 'href' => $routeWithLang('/resources')],
              ['key' => 'news',      'label' => 'News',      'href' => $routeWithLang('/news')],
              ['key' => 'events',    'label' => 'Events',    'href' => $routeWithLang('/events')],
          ],
          'institution' => [
              'label' => 'Institution',
              'aria'  => 'Institution menu',
              'items' => [
                  ['key' => 'about',      'label' => 'About',      'href' => $routeWithLang('/about')],
                  ['key' => 'leadership', 'label' => 'Leadership', 'href' => $routeWithLang('/leadership')],
                  ['key' => 'rules',      'label' => 'Rules',      'href' => $routeWithLang('/rules')],
                  ['key' => 'contacts',   'label' => 'Contacts',   'href' => $routeWithLang('/contacts')],
              ],
          ],
          'guest'        => 'Sign in',
          'logout'       => 'Sign out',
          'dashboard'    => 'Dashboard',
          'lang_aria'    => 'Language switcher',
      ],
  ][$pageLang];

  $localeLabels = ['kk' => 'KK', 'ru' => 'RU', 'en' => 'EN'];
<<<<<<< HEAD
@endphp
<header class="top-0 sticky z-50 transition-all">
  <nav class="bg-slate-50/80 backdrop-blur-md text-blue-950 border-b border-slate-200/60">
    <div class="flex justify-between items-center px-6 md:px-8 py-4 w-full max-w-screen-2xl mx-auto gap-4">
      <a href="{{ $routeWithLang('/') }}" class="inline-flex items-center text-lg md:text-xl font-['Newsreader'] tracking-tight text-blue-950 font-medium whitespace-nowrap align-middle" aria-label="{{ __('ui.brand.home_aria') }}">
        <img src="{{ asset('logo.png') }}" alt="{{ __('ui.brand.title') }} logo" class="navbar-brand-logo sr-only" loading="eager" decoding="async">
        <span class="align-middle leading-tight">{{ __('ui.brand.title') }}</span>
      </a>
=======
  $institutionLockup = [
      'ru' => 'Казахский университет технологии и бизнеса имени К. Кулажанова',
      'kk' => 'Қ. Құлажанов атындағы Қазақ технология және бизнес университеті',
      'en' => 'Kazakh University of Technology and Business named after K. Kulazhanov',
  ];
  $libraryLockup = [
      'ru' => 'Цифровая библиотека',
      'kk' => 'Цифрлық кітапханасы',
      'en' => 'Digital Library',
  ];

  $leftLinks = array_slice($copy['links'], 0, 4);
  $rightLinks = array_slice($copy['links'], 4, 2);
  $institutionKeys = ['about', 'leadership', 'rules', 'contacts'];
  $institutionActive = in_array(($activePage ?? ''), $institutionKeys, true);
@endphp
>>>>>>> 01b6ceb (chore: sync wave2 updates and add comprehensive repository README)

<header class="top-0 sticky z-50 transition-all" id="site-header" data-transparent="true">
  <nav class="header-nav transition-all duration-300">
    <div class="border-b border-slate-200/20 transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-2.5 md:py-3">
        <div class="navbar-grid md:grid md:grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)] md:items-center">
          <div class="md:hidden flex items-center justify-between gap-2">
            <button
              id="mobile-nav-toggle"
              class="mobile-toggle"
              type="button"
              onclick="const nav = document.getElementById('site-nav-mobile'); nav?.classList.toggle('open'); this.setAttribute('aria-expanded', nav?.classList.contains('open') ? 'true' : 'false');"
              aria-label="{{ __('ui.aria.open_menu') }}"
              aria-expanded="false"
              aria-controls="site-nav-mobile"
            >☰</button>

            <a href="{{ $routeWithLang('/') }}" class="navbar-brand navbar-brand-shell inline-flex items-center gap-2.5 min-w-0" aria-label="{{ __('ui.brand.home_aria') }}">
              <div class="navbar-brand-logo-wrap" aria-hidden="true">
                <img src="{{ asset('logo.png') }}" alt="{{ __('ui.brand.title') }} logo" class="navbar-brand-logo navbar-brand-logo--detailed" loading="eager" decoding="async">
              </div>
              <div class="navbar-brand-copy text-center min-w-0">
                <span class="navbar-brand-title line-clamp-1">{{ $institutionLockup[$pageLang] }}</span>
                <span class="navbar-brand-subtitle line-clamp-1">{{ $libraryLockup[$pageLang] }}</span>
              </div>
            </a>

<<<<<<< HEAD
        @php
          $institutionKeys = ['about', 'leadership', 'rules', 'contacts'];
          $institutionActive = in_array(($activePage ?? ''), $institutionKeys, true);
        @endphp
        <details class="nav-disclosure relative" @if($institutionActive) open @endif>
          <summary
            class="font-['Manrope'] text-sm cursor-pointer list-none inline-flex items-center gap-1 transition-colors duration-300 {{ $institutionActive ? 'text-teal-700 font-semibold' : 'text-slate-600 hover:text-teal-600' }}"
            aria-label="{{ $copy['institution']['aria'] }}"
          >
            <span>{{ $copy['institution']['label'] }}</span>
            <span aria-hidden="true" class="text-xs">▾</span>
          </summary>
          <div class="nav-disclosure-panel absolute right-0 mt-2 min-w-[12rem] bg-white border border-slate-200 rounded-md shadow-lg py-2 z-50">
            @foreach($copy['institution']['items'] as $item)
=======
            <a href="{{ $routeWithLang('/dashboard') }}" aria-label="{{ $copy['dashboard'] }}" class="text-slate-600 hover:text-teal-700 transition-colors duration-200 flex items-center shrink-0">
              <span class="material-symbols-outlined text-xl align-middle leading-none" data-icon="account_circle">account_circle</span>
            </a>
          </div>

          <div class="hidden md:flex items-center gap-4 lg:gap-6 justify-self-start">
            @foreach($leftLinks as $item)
>>>>>>> 01b6ceb (chore: sync wave2 updates and add comprehensive repository README)
              <a
                class="font-['Manrope'] text-xs lg:text-sm font-medium transition-colors duration-200 whitespace-nowrap {{ ($activePage ?? '') === ($item['key'] ?? '') ? 'text-teal-700 font-semibold' : 'text-slate-700 hover:text-teal-600' }}"
                href="{{ $item['href'] }}"
              >{{ $item['label'] }}</a>
            @endforeach
          </div>

          <div class="hidden md:flex justify-center">
            <a href="{{ $routeWithLang('/') }}" class="navbar-brand navbar-brand-shell inline-flex items-center gap-3 min-w-0 max-w-md" aria-label="{{ __('ui.brand.home_aria') }}">
              <div class="navbar-brand-logo-wrap" aria-hidden="true">
                <img src="{{ asset('logo.png') }}" alt="{{ __('ui.brand.title') }} logo" class="navbar-brand-logo navbar-brand-logo--detailed" loading="eager" decoding="async">
              </div>
              <div class="navbar-brand-copy min-w-0 text-center">
                <span class="navbar-brand-title line-clamp-2">{{ $institutionLockup[$pageLang] }}</span>
                <span class="navbar-brand-subtitle">{{ $libraryLockup[$pageLang] }}</span>
              </div>
            </a>
          </div>

          <div class="hidden md:flex items-center gap-3 lg:gap-5 justify-self-end">
            @foreach($rightLinks as $item)
              <a
                class="font-['Manrope'] text-xs lg:text-sm font-medium transition-colors duration-200 whitespace-nowrap {{ ($activePage ?? '') === ($item['key'] ?? '') ? 'text-teal-700 font-semibold' : 'text-slate-700 hover:text-teal-600' }}"
                href="{{ $item['href'] }}"
              >{{ $item['label'] }}</a>
            @endforeach

            <div class="h-5 w-px bg-slate-200/80" aria-hidden="true"></div>

            <div class="inline-flex items-center gap-3 lg:gap-4">

            <details class="nav-disclosure relative" @if($institutionActive) open @endif>
              <summary
                class="font-['Manrope'] text-xs lg:text-sm font-medium cursor-pointer list-none inline-flex items-center gap-1 transition-colors duration-200 whitespace-nowrap {{ $institutionActive ? 'text-teal-700 font-semibold' : 'text-slate-700 hover:text-teal-600' }}"
                aria-label="{{ $copy['institution']['aria'] }}"
              >
                <span>{{ $copy['institution']['label'] }}</span>
                <span aria-hidden="true" class="nav-disclosure-caret text-xs">▾</span>
              </summary>
              <div class="nav-disclosure-panel absolute right-0 mt-2 min-w-48 bg-white border border-slate-200 rounded-md shadow-lg py-2 z-50">
                @foreach($copy['institution']['items'] as $item)
                  <a
                    class="block px-4 py-2 font-['Manrope'] text-sm font-medium transition-colors {{ ($activePage ?? '') === ($item['key'] ?? '') ? 'text-teal-700 font-semibold bg-slate-50' : 'text-slate-700 hover:text-teal-700 hover:bg-slate-50' }}"
                    href="{{ $item['href'] }}"
                  >{{ $item['label'] }}</a>
                @endforeach
              </div>
            </details>

            <div class="locale-switcher inline-flex items-center gap-1 rounded-full border border-slate-200 bg-white/75 px-1 py-0.5 text-[11px] lg:text-xs font-['Manrope']" data-locale-switcher role="group" aria-label="{{ $copy['lang_aria'] }}">
              @foreach(['kk', 'ru', 'en'] as $locale)
                <a
                  href="{{ request()->fullUrlWithQuery(['lang' => $locale]) }}"
                  class="px-1.5 lg:px-2 py-0.5 rounded-full transition-colors font-medium text-[10px] lg:text-[11px] {{ $pageLang === $locale ? 'bg-teal-600 text-white font-semibold' : 'text-slate-700 hover:text-teal-700' }}"
                  hreflang="{{ $locale }}"
                  data-locale="{{ $locale }}"
                  @if($pageLang === $locale) aria-current="true" @endif
                >{{ $localeLabels[$locale] }}</a>
              @endforeach
            </div>

            @if($isAuthenticated)
              <a href="{{ $routeWithLang('/dashboard') }}" class="font-['Manrope'] text-xs lg:text-sm font-semibold text-teal-700 hover:opacity-80 transition-all whitespace-nowrap hidden xl:inline">{{ $copy['dashboard'] }}</a>
              <button type="button" id="shared-logout-btn" class="font-['Manrope'] text-xs lg:text-sm font-semibold text-slate-600 hover:text-teal-700 transition-all hidden xl:inline">{{ $copy['logout'] }}</button>
            @else
              <a href="{{ $routeWithLang('/login') }}" class="font-['Manrope'] text-xs lg:text-sm font-semibold text-teal-700 hover:opacity-80 transition-all hidden xl:inline whitespace-nowrap">{{ $copy['guest'] }}</a>
            @endif

            <a href="{{ $routeWithLang('/dashboard') }}" aria-label="{{ $copy['dashboard'] }}" class="text-slate-600 hover:text-teal-700 transition-colors duration-200 flex items-center">
              <span class="material-symbols-outlined text-lg lg:text-xl align-middle leading-none" data-icon="account_circle">account_circle</span>
            </a>
            </div>
          </div>
        </div>

        <div id="site-nav-mobile" class="nav-links-mobile md:hidden" aria-label="{{ __('ui.aria.main_navigation') }}">
          @foreach($copy['links'] as $item)
            <a
              class="font-['Manrope'] text-sm font-medium transition-colors duration-200 {{ ($activePage ?? '') === ($item['key'] ?? '') ? 'text-teal-700 font-semibold' : 'text-slate-700 hover:text-teal-600' }}"
              href="{{ $item['href'] }}"
            >{{ $item['label'] }}</a>
          @endforeach

          <details class="nav-disclosure" @if($institutionActive) open @endif>
            <summary
              class="font-['Manrope'] text-sm font-medium cursor-pointer list-none inline-flex items-center gap-1 transition-colors duration-200 {{ $institutionActive ? 'text-teal-700 font-semibold' : 'text-slate-700 hover:text-teal-600' }}"
              aria-label="{{ $copy['institution']['aria'] }}"
            >
              <span>{{ $copy['institution']['label'] }}</span>
              <span aria-hidden="true" class="nav-disclosure-caret text-xs">▾</span>
            </summary>
            <div class="mt-1 pl-2 border-l border-slate-200">
              @foreach($copy['institution']['items'] as $item)
                <a
                  class="block py-1.5 font-['Manrope'] text-sm font-medium transition-colors {{ ($activePage ?? '') === ($item['key'] ?? '') ? 'text-teal-700 font-semibold' : 'text-slate-700 hover:text-teal-700' }}"
                  href="{{ $item['href'] }}"
                >{{ $item['label'] }}</a>
              @endforeach
            </div>
          </details>

          <div class="locale-switcher inline-flex items-center gap-1 rounded-full border border-slate-200 bg-white px-1 py-0.5 text-[11px] font-['Manrope'] mt-1" role="group" aria-label="{{ $copy['lang_aria'] }}">
            @foreach(['kk', 'ru', 'en'] as $locale)
              <a
                href="{{ request()->fullUrlWithQuery(['lang' => $locale]) }}"
                class="px-1.5 py-0.5 rounded-full transition-colors font-medium text-[10px] {{ $pageLang === $locale ? 'bg-teal-600 text-white font-semibold' : 'text-slate-700 hover:text-teal-700' }}"
                hreflang="{{ $locale }}"
                @if($pageLang === $locale) aria-current="true" @endif
              >{{ $localeLabels[$locale] }}</a>
            @endforeach
          </div>

          @if($isAuthenticated)
            <a href="{{ $routeWithLang('/dashboard') }}" class="font-['Manrope'] text-sm font-semibold text-teal-700 hover:opacity-80 transition-all">{{ $copy['dashboard'] }}</a>
          @else
            <a href="{{ $routeWithLang('/login') }}" class="font-['Manrope'] text-sm font-semibold text-teal-700 hover:opacity-80 transition-all">{{ $copy['guest'] }}</a>
          @endif
        </div>
      </div>
    </div>
  </nav>
</header>
<<<<<<< HEAD
=======

<style>
  .header-nav {
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(248, 249, 250, 0) 100%);
    border-bottom-color: transparent;
    backdrop-filter: blur(0);
  }

  .header-nav.solid {
    background: linear-gradient(to bottom, rgba(248, 249, 250, 0.95) 0%, rgba(248, 249, 250, 0.92) 100%);
    border-bottom-color: rgba(226, 232, 240, 0.55);
    backdrop-filter: blur(12px);
    box-shadow: 0 6px 20px rgba(15, 23, 42, 0.06);
  }

  .mobile-toggle {
    font-size: 1.25rem;
    padding: 0.5rem;
    color: #334155;
  }

  .navbar-grid {
    min-height: 4.25rem;
  }

  .navbar-brand {
    text-decoration: none;
  }

  .navbar-brand-shell {
    padding: 0.2rem 0.55rem;
    border-radius: 9999px;
    background: rgba(255, 255, 255, 0.6);
    border: 1px solid rgba(226, 232, 240, 0.7);
    box-shadow: 0 2px 12px rgba(15, 23, 42, 0.04);
  }

  .navbar-brand-logo-wrap {
    width: 48px;
    height: 48px;
    border-radius: 9999px;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.12);
    border: 1px solid rgba(148, 163, 184, 0.35);
    flex-shrink: 0;
  }

  .navbar-brand-logo--detailed {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 1px;
    transform-origin: center;
  }

  .navbar-brand-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-width: 0;
    line-height: 1.1;
  }

  .navbar-brand-title {
    display: block;
    font-family: 'Manrope', sans-serif;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0;
    line-height: 1.2;
    color: #0f172a;
  }

  .navbar-brand-subtitle {
    display: block;
    margin-top: 0.08rem;
    font-family: 'Manrope', sans-serif;
    font-size: 0.56rem;
    font-weight: 600;
    letter-spacing: 0.02em;
    text-transform: none;
    color: #0f766e;
    line-height: 1.3;
  }

  .nav-disclosure-caret {
    transition: transform 160ms ease;
  }

  .nav-disclosure[open] .nav-disclosure-caret {
    transform: rotate(180deg);
  }

  .nav-disclosure[open] .nav-disclosure-panel {
    animation: navDisclosureIn 160ms cubic-bezier(0.22, 1, 0.36, 1);
    transform-origin: top right;
  }

  @keyframes navDisclosureIn {
    from {
      opacity: 0;
      transform: translateY(-6px) scale(0.98);
    }

    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .nav-links-mobile {
    display: none;
    margin-top: 0.75rem;
    padding: 0.9rem 1rem;
    border: 1px solid rgba(226, 232, 240, 0.8);
    border-radius: 0.9rem;
    background: rgba(255, 255, 255, 0.97);
    box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    flex-direction: column;
    gap: 0.65rem;
  }

  .nav-links-mobile.open {
    display: flex;
  }

  @media (min-width: 768px) {
    .navbar-brand-logo-wrap {
      width: 54px;
      height: 54px;
    }

    .navbar-brand-title {
      font-size: 0.7rem;
    }

    .navbar-brand-subtitle {
      font-size: 0.58rem;
    }

    .navbar-brand-copy {
      max-width: 17rem;
    }
  }

  @media (min-width: 1280px) {
    .navbar-brand-copy {
      max-width: 19rem;
    }
  }

  @media (max-width: 767px) {
    .navbar-brand-shell {
      padding: 0.12rem 0.3rem;
      border-color: rgba(226, 232, 240, 0.6);
      box-shadow: none;
      background: rgba(255, 255, 255, 0.5);
    }

    .navbar-brand-title {
      font-size: 0.58rem;
    }

    .navbar-brand-subtitle {
      font-size: 0.5rem;
      letter-spacing: 0.02em;
    }

    .navbar-brand-copy {
      max-width: 12.5rem;
    }

    .nav-disclosure .nav-disclosure-panel {
      position: static;
      margin-top: 0.5rem;
      min-width: 0;
      border-radius: 0.5rem;
      box-shadow: none;
      border: 1px solid rgba(226, 232, 240, 0.7);
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .nav-disclosure-caret {
      transition: none;
    }

    .nav-disclosure[open] .nav-disclosure-panel {
      animation: none;
    }
  }
</style>

<script>
  (() => {
    const hasHoverPointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    if (!hasHoverPointer) {
      return;
    }

    document.querySelectorAll('details.nav-disclosure').forEach((dropdown) => {
      let closeTimer = null;

      const openMenu = () => {
        if (closeTimer) {
          clearTimeout(closeTimer);
          closeTimer = null;
        }

        dropdown.open = true;
      };

      const closeMenuWithDelay = () => {
        if (closeTimer) {
          clearTimeout(closeTimer);
        }

        closeTimer = setTimeout(() => {
          if (!dropdown.matches(':hover')) {
            dropdown.open = false;
          }
        }, 180);
      };

      dropdown.addEventListener('mouseenter', openMenu);
      dropdown.addEventListener('mouseleave', closeMenuWithDelay);

      const summary = dropdown.querySelector('summary');
      const panel = dropdown.querySelector('.nav-disclosure-panel');

      summary?.addEventListener('focus', openMenu);
      panel?.addEventListener('mouseenter', openMenu);
      panel?.addEventListener('mouseleave', closeMenuWithDelay);
    });
  })();

  (() => {
    const header = document.getElementById('site-header');
    const nav = document.querySelector('.header-nav');
    const mobileToggle = document.getElementById('mobile-nav-toggle');
    const mobileNav = document.getElementById('site-nav-mobile');

    if (!header || !nav) {
      return;
    }

    const handleScroll = () => {
      const scrollY = window.scrollY || window.pageYOffset;
      if (scrollY > 50) {
        nav.classList.add('solid');
        header.setAttribute('data-transparent', 'false');
      } else {
        nav.classList.remove('solid');
        header.setAttribute('data-transparent', 'true');
      }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    document.addEventListener('click', (event) => {
      if (!mobileNav || !mobileToggle || !mobileNav.classList.contains('open')) {
        return;
      }

      const target = event.target;
      if (!(target instanceof Element)) {
        return;
      }

      if (!mobileNav.contains(target) && !mobileToggle.contains(target)) {
        mobileNav.classList.remove('open');
        mobileToggle.setAttribute('aria-expanded', 'false');
      }
    });

    window.addEventListener('resize', () => {
      if (!mobileNav || !mobileToggle) {
        return;
      }

      if (window.innerWidth >= 768) {
        mobileNav.classList.remove('open');
        mobileToggle.setAttribute('aria-expanded', 'false');
      }
    });
  })();
</script>
>>>>>>> 01b6ceb (chore: sync wave2 updates and add comprehensive repository README)
