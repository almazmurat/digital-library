@extends('layouts.public', ['activePage' => 'home'])

@php
  $lang = app()->getLocale();
  $lang = in_array($lang, ['kk', 'ru', 'en'], true) ? $lang : 'ru';

  $withLang = function (string $path, array $query = []) use ($lang): string {
      $normalizedPath = '/' . ltrim($path, '/');
      if ($normalizedPath === '//') {
          $normalizedPath = '/';
      }

      if ($lang !== 'ru' && ! array_key_exists('lang', $query)) {
          $query['lang'] = $lang;
      }

      $query = array_filter($query, static fn ($value) => $value !== null && $value !== '');

      return $normalizedPath . ($query ? ('?' . http_build_query($query)) : '');
  };

  $chrome = [
      'ru' => [
          'title'                    => 'Главная — Библиотека КазТБУ',
          'hero_kicker'              => 'Цифровой куратор',
          'hero_h1'                  => 'Открывайте знания,',
          'hero_h1_accent'           => 'управляйте источниками.',
          'hero_lead'                => 'Единая точка доступа к академическим коллекциям, научным архивам и цифровым ресурсам КазТБУ.',
          'search_placeholder'       => 'Поиск по каталогу, авторам, УДК…',
          'search_cta'               => 'Найти',
          'trending'                 => 'Актуальные темы:',
          'hero_img_alt'             => 'Читальный зал библиотеки КазТБУ',
          'stats_archives_label'     => 'Архивных материалов',
          'stats_archives_value'     => '8 930+',
          'stats_scholars_label'     => 'Научных коллекций',
          'stats_scholars_value'     => '100+',
          'collections_heading'      => 'Избранные коллекции',
          'collections_lead'         => 'Тематические подборки по ключевым дисциплинам КазТБУ',
          'collections_all_cta'      => 'Все коллекции',
          'collection_featured_badge'   => 'Основной фонд',
          'collection_featured_title'   => 'Академические ресурсы',
          'collection_featured_body'    => 'Монографии, диссертации и периодика по профильным направлениям университета: инженерия, экономика, право.',
          'collection_featured_cta'     => 'Открыть каталог',
          'collection_featured_img_alt' => 'Читальный зал библиотеки КазТБУ',
          'collection_tile1_title'   => 'Прикладные науки',
          'collection_tile1_body'    => 'Технические и инженерные дисциплины (УДК 5)',
          'collection_tile1_img_alt' => 'Семинар ИИ',
          'collection_tile2_title'   => 'Экономика и право',
          'collection_tile2_body'    => 'Правовые и экономические исследования (УДК 33)',
          'collection_tile2_img_alt' => 'Классический фонд',
          'services_heading'         => 'Научные сервисы',
          'services_lead'            => 'Инструменты и ресурсы для академической работы',
          'gateway_heading'          => 'Навигационный центр библиотеки',
          'gateway_lead'             => 'Переходите к ключевым публичным разделам: от каталога и репозитория до новостей, правил и контактов.',
          'gateway_meta'             => 'Public Gateway',
          'services'                 => [
              ['icon' => 'library_books', 'title' => 'Справочное обслуживание', 'body' => 'Помощь с поиском источников, составлением библиографических списков и тематических подборок.', 'cta' => 'Задать вопрос'],
              ['icon' => 'school',        'title' => 'Учебные коллекции',      'body' => 'Рекомендуемая литература по учебным программам: учебники, методические пособия и статьи.', 'cta' => 'Каталог программ'],
              ['icon' => 'workspace_premium', 'title' => 'Личный кабинет',    'body' => 'Управление займами, бронированием и персональными списками чтения.',                       'cta' => session('library.user') ? 'Открыть кабинет' : 'Войти'],
          ],
          'identity_brand' => 'Библиотека КазТБУ',
      ],
      'kk' => [
          'title'                    => 'Басты бет — КазТБУ Кітапханасы',
          'hero_kicker'              => 'Цифрлық куратор',
          'hero_h1'                  => 'Білімді ашыңыз,',
          'hero_h1_accent'           => 'дереккөздерді басқарыңыз.',
          'hero_lead'                => 'КазТБУ академиялық жинақтарына, ғылыми мұрағаттар мен цифрлық ресурстарға бірыңғай кіру нүктесі.',
          'search_placeholder'       => 'Каталог, авторлар, ӘЖЖ бойынша іздеу…',
          'search_cta'               => 'Іздеу',
          'trending'                 => 'Өзекті тақырыптар:',
          'hero_img_alt'             => 'КазТБУ кітапханасының оқу залы',
          'stats_archives_label'     => 'Мұрағат материалдары',
          'stats_archives_value'     => '8 930+',
          'stats_scholars_label'     => 'Ғылыми жинақтар',
          'stats_scholars_value'     => '100+',
          'collections_heading'      => 'Таңдаулы жинақтар',
          'collections_lead'         => 'КазТБУ негізгі пәндері бойынша тақырыптық іріктемелер',
          'collections_all_cta'      => 'Барлық жинақтар',
          'collection_featured_badge'   => 'Негізгі қор',
          'collection_featured_title'   => 'Академиялық ресурстар',
          'collection_featured_body'    => 'Университеттің профильді бағыттары: инженерия, экономика, құқық бойынша монографиялар, диссертациялар және мерзімді басылымдар.',
          'collection_featured_cta'     => 'Каталогты ашу',
          'collection_featured_img_alt' => 'КазТБУ кітапханасының оқу залы',
          'collection_tile1_title'   => 'Қолданбалы ғылымдар',
          'collection_tile1_body'    => 'Техникалық және инженерлік пәндер (ӘЖЖ 5)',
          'collection_tile1_img_alt' => 'AI семинары',
          'collection_tile2_title'   => 'Экономика және құқық',
          'collection_tile2_body'    => 'Құқықтық және экономикалық зерттеулер (ӘЖЖ 33)',
          'collection_tile2_img_alt' => 'Классикалық қор',
          'services_heading'         => 'Ғылыми сервистер',
          'services_lead'            => 'Академиялық жұмыс үшін құралдар мен ресурстар',
          'gateway_heading'          => 'Кітапхана навигация орталығы',
          'gateway_lead'             => 'Каталогтан репозиторийге дейін, жаңалықтардан ережелер мен байланысқа дейін негізгі қоғамдық бөлімдерге өтіңіз.',
          'gateway_meta'             => 'Public Gateway',
          'services'                 => [
              ['icon' => 'library_books', 'title' => 'Анықтамалық қызмет',  'body' => 'Дереккөздерді іздеуге, библиографиялық тізімдер мен тақырыптық іріктемелер жасауға көмек.', 'cta' => 'Сұрақ қою'],
              ['icon' => 'school',        'title' => 'Оқу жинақтары',       'body' => 'Оқу бағдарламалары бойынша ұсынылған әдебиет: оқулықтар, әдістемелік құралдар және мақалалар.', 'cta' => 'Бағдарламалар каталогы'],
              ['icon' => 'workspace_premium', 'title' => 'Жеке кабинет',   'body' => 'Қарыздарды, броньдарды және жеке оқу тізімдерін басқару.',                                        'cta' => session('library.user') ? 'Кабинетті ашу' : 'Кіру'],
          ],
          'identity_brand' => 'КазТБУ Кітапханасы',
      ],
      'en' => [
          'title'                    => 'Home — KazUTB Digital Library',
          'hero_kicker'              => 'Digital Curator',
          'hero_h1'                  => 'Discover Knowledge,',
          'hero_h1_accent'           => 'Curate Your Sources.',
          'hero_lead'                => 'A single gateway to KazUTB\'s academic collections, scholarly archives, and digital resources.',
          'search_placeholder'       => 'Search by title, author, UDC…',
          'search_cta'               => 'Search',
          'trending'                 => 'Trending topics:',
          'hero_img_alt'             => 'KazUTB Library Reading Room',
          'stats_archives_label'     => 'Indexed Items',
          'stats_archives_value'     => '8,930+',
          'stats_scholars_label'     => 'Research Collections',
          'stats_scholars_value'     => '100+',
          'collections_heading'      => 'Curated Collections',
          'collections_lead'         => 'Thematic selections across KazUTB\'s key disciplines',
          'collections_all_cta'      => 'All Collections',
          'collection_featured_badge'   => 'Core Collection',
          'collection_featured_title'   => 'Academic Resources',
          'collection_featured_body'    => 'Monographs, dissertations and periodicals across KazUTB\'s flagship disciplines: engineering, economics, and law.',
          'collection_featured_cta'     => 'Open Catalog',
          'collection_featured_img_alt' => 'KazUTB Library Reading Room',
          'collection_tile1_title'   => 'Applied Sciences',
          'collection_tile1_body'    => 'Technical & engineering disciplines (UDC 5)',
          'collection_tile1_img_alt' => 'AI Workshop',
          'collection_tile2_title'   => 'Economics &amp; Law',
          'collection_tile2_body'    => 'Legal and economic research (UDC 33)',
          'collection_tile2_img_alt' => 'Classics Collection',
          'services_heading'         => 'Scholarly Services',
          'services_lead'            => 'Tools and resources for academic work',
          'gateway_heading'          => 'Library Navigation Hub',
          'gateway_lead'             => 'Jump to all core public sections, from catalog and repository to news, rules, leadership, and contacts.',
          'gateway_meta'             => 'Public Gateway',
          'services'                 => [
              ['icon' => 'library_books',    'title' => 'Reference Services',  'body' => 'Expert help with source discovery, bibliography building, and subject-specific reading lists.', 'cta' => 'Ask a Question'],
              ['icon' => 'school',           'title' => 'Course Collections',  'body' => 'Recommended reading aligned with academic programmes: textbooks, guides, and articles.',       'cta' => 'Browse Programmes'],
              ['icon' => 'workspace_premium','title' => 'Member Workspace',    'body' => 'Manage your loans, reservations, and personal reading lists.',                                  'cta' => session('library.user') ? 'Open Workspace' : 'Sign In'],
          ],
            'identity_brand' => 'KazUTB Digital Library',
      ],
  ];

  $copy = $chrome[$lang];

  $topicLinks = [
      'ru' => [
          ['label' => 'Экономическая реформа',    'href' => $withLang('/catalog', ['udc' => '33'])],
          ['label' => 'Устойчивые технологии',    'href' => $withLang('/catalog', ['udc' => '62'])],
          ['label' => 'История Центральной Азии', 'href' => $withLang('/catalog', ['udc' => '008'])],
      ],
      'kk' => [
          ['label' => 'Экономикалық реформа',  'href' => $withLang('/catalog', ['udc' => '33'])],
          ['label' => 'Тұрақты технологиялар', 'href' => $withLang('/catalog', ['udc' => '62'])],
          ['label' => 'Орта Азия тарихы',      'href' => $withLang('/catalog', ['udc' => '008'])],
      ],
      'en' => [
          ['label' => 'Economic Reform',       'href' => $withLang('/catalog', ['udc' => '33'])],
          ['label' => 'Sustainable Tech',      'href' => $withLang('/catalog', ['udc' => '62'])],
          ['label' => 'Central Asian History', 'href' => $withLang('/catalog', ['udc' => '008'])],
      ],
  ];
  $topics = $topicLinks[$lang];

  $serviceHrefs = [
      $withLang('/contacts'),
      $withLang('/contacts'),
      session('library.user') ? $withLang('/dashboard') : $withLang('/login'),
  ];

  $serviceIconBg = [
      'bg-tertiary-fixed/30 text-on-tertiary-fixed-variant',
      'bg-primary-fixed/30 text-on-primary-fixed-variant',
      'bg-secondary-container/30 text-on-secondary-container',
  ];

  $gatewayLinks = [
      ['label' => $lang === 'ru' ? 'Каталог' : ($lang === 'kk' ? 'Каталог' : 'Catalog'), 'href' => $withLang('/catalog')],
      ['label' => $lang === 'ru' ? 'Открытия' : ($lang === 'kk' ? 'Ашылымдар' : 'Discover'), 'href' => $withLang('/discover')],
      ['label' => $lang === 'ru' ? 'Ресурсы' : ($lang === 'kk' ? 'Ресурстар' : 'Resources'), 'href' => $withLang('/resources')],
      ['label' => $lang === 'ru' ? 'Репозиторий' : ($lang === 'kk' ? 'Репозиторий' : 'Repository'), 'href' => $withLang('/repository')],
      ['label' => $lang === 'ru' ? 'Новости' : ($lang === 'kk' ? 'Жаңалықтар' : 'News'), 'href' => $withLang('/news')],
      ['label' => $lang === 'ru' ? 'События' : ($lang === 'kk' ? 'Іс-шаралар' : 'Events'), 'href' => $withLang('/events')],
      ['label' => $lang === 'ru' ? 'О библиотеке' : ($lang === 'kk' ? 'Кітапхана туралы' : 'About'), 'href' => $withLang('/about')],
      ['label' => $lang === 'ru' ? 'Руководство' : ($lang === 'kk' ? 'Басшылық' : 'Leadership'), 'href' => $withLang('/leadership')],
      ['label' => $lang === 'ru' ? 'Правила' : ($lang === 'kk' ? 'Ережелер' : 'Rules'), 'href' => $withLang('/rules')],
      ['label' => $lang === 'ru' ? 'Контакты' : ($lang === 'kk' ? 'Байланыс' : 'Contacts'), 'href' => $withLang('/contacts')],
  ];

      $gatewayMeta = [
        ['icon' => 'library_books', 'tone' => 'bg-secondary-container/60 text-secondary', 'subtitle' => $lang === 'ru' ? 'Поиск и доступ' : ($lang === 'kk' ? 'Іздеу және қолжетімділік' : 'Search and access')],
        ['icon' => 'search', 'tone' => 'bg-primary-container/55 text-primary', 'subtitle' => $lang === 'ru' ? 'Подборки и подбор' : ($lang === 'kk' ? 'Іріктемелер мен ашылымдар' : 'Curated discovery')],
        ['icon' => 'database', 'tone' => 'bg-tertiary-container/55 text-tertiary', 'subtitle' => $lang === 'ru' ? 'Коллекции и базы' : ($lang === 'kk' ? 'Жинақтар мен дерекқорлар' : 'Collections and databases')],
        ['icon' => 'inventory_2', 'tone' => 'bg-primary-fixed/30 text-primary', 'subtitle' => $lang === 'ru' ? 'Архив и репозиторий' : ($lang === 'kk' ? 'Мұрағат және репозиторий' : 'Archive and repository')],
        ['icon' => 'newspaper', 'tone' => 'bg-secondary-fixed/30 text-secondary', 'subtitle' => $lang === 'ru' ? 'Новости и анонсы' : ($lang === 'kk' ? 'Жаңалықтар мен анонстар' : 'News and announcements')],
        ['icon' => 'event', 'tone' => 'bg-tertiary-fixed/30 text-tertiary', 'subtitle' => $lang === 'ru' ? 'Календарь библиотеки' : ($lang === 'kk' ? 'Кітапхана күнтізбесі' : 'Library calendar')],
        ['icon' => 'account_balance', 'tone' => 'bg-primary-container/55 text-primary', 'subtitle' => $lang === 'ru' ? 'Миссия и профиль' : ($lang === 'kk' ? 'Миссия және профиль' : 'Mission and profile')],
        ['icon' => 'badge', 'tone' => 'bg-secondary-container/55 text-secondary', 'subtitle' => $lang === 'ru' ? 'Команда и контакты' : ($lang === 'kk' ? 'Команда және байланыс' : 'Team and contacts')],
        ['icon' => 'gavel', 'tone' => 'bg-primary-fixed/30 text-primary', 'subtitle' => $lang === 'ru' ? 'Условия пользования' : ($lang === 'kk' ? 'Пайдалану шарттары' : 'Use conditions')],
        ['icon' => 'call', 'tone' => 'bg-secondary-fixed/30 text-secondary', 'subtitle' => $lang === 'ru' ? 'Помощь и визит' : ($lang === 'kk' ? 'Көмек пен келу' : 'Help and visit')],
      ];

      $hubImages = [
        'about' => ['src' => '/images/news/campus-library.jpg', 'alt' => $copy['hero_img_alt']],
        'leadership' => ['src' => '/images/news/author-visit.jpg', 'alt' => $lang === 'en' ? 'Library leadership meeting' : ($lang === 'kk' ? 'Кітапхана басшылығымен кездесу' : 'Встреча с руководством библиотеки')],
        'rules' => ['src' => '/images/news/classics-event.jpg', 'alt' => $lang === 'en' ? 'Library collection display' : ($lang === 'kk' ? 'Кітапхана қорларының көрмесі' : 'Книжная выставка и фонды библиотеки')],
        'contacts' => ['src' => '/images/news/default-library.jpg', 'alt' => $lang === 'en' ? 'KazUTB main building' : ($lang === 'kk' ? 'ҚазТБУ негізгі корпусы' : 'Главный корпус КазТБУ')],
        'news' => ['src' => '/images/news/ai-workshop.jpg', 'alt' => $lang === 'en' ? 'Digital preservation research session' : ($lang === 'kk' ? 'Цифрлық сақтау бойынша зерттеу сессиясы' : 'Исследовательская сессия по цифровому сохранению')],
        'events' => ['src' => '/images/news/campus-library.jpg', 'alt' => $lang === 'en' ? 'Symposium in the reading room' : ($lang === 'kk' ? 'Оқу залындағы симпозиум' : 'Симпозиум в читальном зале')],
      ];

      $hubCards = [
        'ru' => [
          'about' => ['eyebrow' => 'О библиотеке', 'title' => 'Институциональная библиотека', 'body' => 'Сохраняем знание. Поддерживаем исследования. Университетская библиотека соединяет академическую традицию и цифровой сервис.', 'cta' => 'Открыть раздел', 'href' => $withLang('/about'), 'icon' => 'account_balance'],
          'leadership' => ['eyebrow' => 'Руководство', 'title' => 'Команда и зоны ответственности', 'body' => 'Руководство координирует академические сервисы, цифровые коллекции и институциональные процессы библиотеки.', 'cta' => 'Открыть раздел', 'href' => $withLang('/leadership'), 'icon' => 'badge'],
          'rules' => ['eyebrow' => 'Правила', 'title' => 'Пользование фондом и ресурсами', 'body' => 'Условия записи, выдачи, пользования фондом и доступа к цифровым ресурсам.', 'cta' => 'Открыть правила', 'href' => $withLang('/rules'), 'icon' => 'gavel'],
          'contacts' => ['eyebrow' => 'Контакты', 'title' => 'Адрес, часы и каналы поддержки', 'body' => 'Адрес, режим работы и способы связаться с библиотекой для консультаций, доступа и административных вопросов.', 'cta' => 'Открыть контакты', 'href' => $withLang('/contacts'), 'icon' => 'call'],
          'news' => ['eyebrow' => 'Новости', 'title' => 'Архивная целостность и цифровое сохранение', 'body' => 'Исследователи и специалисты по цифровому сохранению обсудили долгосрочное хранение, связность метаданных и контролируемый доступ.', 'meta' => '14 апреля 2026 · Главный материал', 'cta' => 'Все новости', 'href' => $withLang('/news'), 'icon' => 'newspaper'],
          'events' => ['eyebrow' => 'События', 'title' => 'Цифровое сохранение фондов', 'body' => 'Открытая сессия для преподавателей и исследователей о цифровом сохранении материалов, метаданных и долгосрочном хранении.', 'meta' => '14 мая 2026 · Симпозиум', 'cta' => 'Все события', 'href' => $withLang('/events'), 'icon' => 'event'],
        ],
        'kk' => [
          'about' => ['eyebrow' => 'Кітапхана туралы', 'title' => 'Институционалдық кітапхана', 'body' => 'Білімді сақтаймыз. Зерттеуді қолдаймыз. Университет кітапханасы академиялық дәстүр мен цифрлық сервисті біріктіреді.', 'cta' => 'Бөлімді ашу', 'href' => $withLang('/about'), 'icon' => 'account_balance'],
          'leadership' => ['eyebrow' => 'Басшылық', 'title' => 'Команда және жауапкершілік аймақтары', 'body' => 'Басшылық кітапхананың академиялық сервистерін, цифрлық жинақтарын және институционалдық процестерін үйлестіреді.', 'cta' => 'Бөлімді ашу', 'href' => $withLang('/leadership'), 'icon' => 'badge'],
          'rules' => ['eyebrow' => 'Ережелер', 'title' => 'Қорды және ресурстарды пайдалану', 'body' => 'Тіркелу, беру, қорды пайдалану және цифрлық ресурстарға қолжетімділік шарттары.', 'cta' => 'Ережелерді ашу', 'href' => $withLang('/rules'), 'icon' => 'gavel'],
          'contacts' => ['eyebrow' => 'Байланыс', 'title' => 'Мекенжай, жұмыс уақыты және қолдау арналары', 'body' => 'Кітапханамен кеңес, қолжетімділік және әкімшілік сұрақтар бойынша байланысу жолдары.', 'cta' => 'Байланыстарды ашу', 'href' => $withLang('/contacts'), 'icon' => 'call'],
          'news' => ['eyebrow' => 'Жаңалықтар', 'title' => 'Мұрағат тұтастығы және цифрлық сақтау', 'body' => 'Зерттеушілер мен цифрлық сақтау мамандары ұзақ мерзімді сақтау, метадеректер байланыстылығы және бақыланатын қолжетімділікті талқылады.', 'meta' => '2026 жылғы 14 сәуір · Басты материал', 'cta' => 'Барлық жаңалықтар', 'href' => $withLang('/news'), 'icon' => 'newspaper'],
          'events' => ['eyebrow' => 'Іс-шаралар', 'title' => 'Қорларды цифрлық сақтау', 'body' => 'Оқытушылар мен зерттеушілерге арналған ашық сессия: материалдарды цифрлық сақтау, метадеректер және ұзақ мерзімді сақтау.', 'meta' => '2026 жылғы 14 мамыр · Симпозиум', 'cta' => 'Барлық іс-шаралар', 'href' => $withLang('/events'), 'icon' => 'event'],
        ],
        'en' => [
          'about' => ['eyebrow' => 'About', 'title' => 'Institutional library', 'body' => 'Preserving knowledge. Supporting research. The university library brings academic tradition and digital service together.', 'cta' => 'Open the section', 'href' => $withLang('/about'), 'icon' => 'account_balance'],
          'leadership' => ['eyebrow' => 'Leadership', 'title' => 'Team and responsibility areas', 'body' => 'Library leadership coordinates academic services, digital collections, and institutional workflows.', 'cta' => 'Open the section', 'href' => $withLang('/leadership'), 'icon' => 'badge'],
          'rules' => ['eyebrow' => 'Rules', 'title' => 'Use of the collection and resources', 'body' => 'Registration, loans, collection use, and access to digital resources.', 'cta' => 'Open rules', 'href' => $withLang('/rules'), 'icon' => 'gavel'],
          'contacts' => ['eyebrow' => 'Contacts', 'title' => 'Address, hours, and support channels', 'body' => 'How to reach the library for consultations, access questions, and administrative matters.', 'cta' => 'Open contacts', 'href' => $withLang('/contacts'), 'icon' => 'call'],
          'news' => ['eyebrow' => 'News', 'title' => 'Archival integrity and digital preservation', 'body' => 'Researchers and digital preservation specialists discussed long-term retention, metadata continuity, and controlled access.', 'meta' => 'April 14, 2026 · Featured report', 'cta' => 'All news', 'href' => $withLang('/news'), 'icon' => 'newspaper'],
          'events' => ['eyebrow' => 'Events', 'title' => 'Digital preservation of collections', 'body' => 'An open session for faculty and researchers on digital preservation, metadata workflows, and long-term retention.', 'meta' => 'May 14, 2026 · Symposium', 'cta' => 'All events', 'href' => $withLang('/events'), 'icon' => 'event'],
        ],
      ][$lang];
@endphp

@section('title', $copy['title'])

@section('head')
<style>
.homepage-canonical__hero-img {
    position: absolute; inset: 0; width: 100%; height: 100%;
    object-fit: cover; opacity: 1;
}
.homepage-canonical__bento-img {
    position: absolute; inset: 0; width: 100%; height: 100%;
    object-fit: cover; transition: transform .7s; opacity: 1;
}
.homepage-canonical__bento-tile:hover .homepage-canonical__bento-img { transform: scale(1.05); }
.homepage-canonical__bento-tile:hover { transform: translateY(-4px); }
.homepage-canonical__stats-card {
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}
</style>
@endsection

@section('content')
<div data-section="homepage-canonical-page">

  {{-- ── Hidden institutional identity mark (accessibility / test wiring) ── --}}
  <div id="hero-campus-mark" class="sr-only" aria-hidden="true">
    <span>{{ $copy['identity_brand'] }}</span>
  </div>

  {{-- ══════════════════════════════════════════════════════════════
       SECTION 1 — HERO (Premium curator-style design)
       ════════════════════════════════════════════════════════════ --}}
  <section data-section="homepage-canonical-hero"
           class="w-full bg-surface-container-lowest/40 mb-20">
    <div class="max-w-7xl mx-auto px-6 md:px-12 py-20 md:py-32">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-stretch">

        {{-- Left column: Premium typography + CTA --}}
        <div class="flex flex-col items-start justify-center space-y-10">

          <div class="space-y-4">
            <span data-test-id="homepage-canonical-kicker"
                  class="inline-block text-secondary font-bold text-xs tracking-[0.16em] uppercase px-3 py-1.5 bg-secondary/10 rounded-full">
              {{ $copy['hero_kicker'] }}
            </span>

            <h1 class="text-5xl md:text-6xl lg:text-[3.75rem] leading-[1.15] font-display font-bold text-primary">
              {{ $copy['hero_h1'] }}<br>
              <span class="italic font-light text-primary/75">{{ $copy['hero_h1_accent'] }}</span>
            </h1>
          </div>

          <p class="text-lg text-on-surface-variant max-w-xl leading-relaxed font-body">
            {{ $copy['hero_lead'] }}
          </p>

          {{-- Premium Search Bar --}}
          <form id="heroSearch"
                data-test-id="homepage-canonical-search"
                class="hero-search-bar w-full max-w-lg bg-white shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-2xl flex items-center overflow-hidden border border-outline/10 hover:shadow-[0_12px_48px_rgba(0,0,0,0.12)] transition-shadow"
                action="{{ $withLang('/catalog') }}"
                method="get">
            <span class="material-symbols-outlined text-outline ml-5 mr-3 text-xl">search</span>
            <input class="flex-1 bg-transparent border-none focus:ring-0 text-on-surface placeholder:text-outline-variant font-body text-base py-4"
                   type="text"
                   name="q"
                   placeholder="{{ $copy['search_placeholder'] }}">
            <button type="submit"
                    class="bg-linear-to-r from-primary to-primary-container text-on-primary px-8 py-4 font-semibold text-sm hover:shadow-[0_8px_24px_rgba(0,0,0,0.15)] transition-all mr-1 whitespace-nowrap">
              {{ $copy['search_cta'] }}
            </button>
          </form>

          {{-- Trending Topics --}}
          <div id="hero-quick-links" class="flex flex-wrap gap-2.5 items-center pt-4">
            <span class="text-xs text-on-surface-variant font-semibold uppercase tracking-wider">{{ $copy['trending'] }}</span>
            @foreach ($topics as $link)
              <a href="{{ $link['href'] }}"
                 class="text-sm text-secondary font-medium hover:text-secondary-container transition-colors px-3 py-1.5 rounded-full hover:bg-secondary/10">
                {{ $link['label'] }}
              </a>
            @endforeach
          </div>

        </div>{{-- /left --}}

        {{-- Right column: Hero Image with Premium Stats Card --}}
        <div class="relative h-96 lg:h-136 rounded-3xl overflow-hidden bg-surface-container-low shadow-[0_28px_80px_rgba(0,6,19,0.18)] ring-1 ring-outline-variant/20">

          {{-- Background Image --}}
          <img src="/images/news/campus-library.jpg"
               alt="{{ $copy['hero_img_alt'] }}"
               class="homepage-canonical__hero-img absolute inset-0 w-full h-full object-cover opacity-100">

          {{-- Gradient Overlays (refined) --}}
          <div class="absolute inset-0 bg-linear-to-tr from-primary-container/35 via-primary-container/10 to-transparent"></div>
          <div class="absolute inset-x-0 bottom-0 h-32 bg-linear-to-t from-primary/45 via-primary/15 to-transparent"></div>

          {{-- Floating Card: "Calm Gateway" --}}
          <div class="absolute top-8 left-8 right-8 max-w-xs rounded-2xl bg-white/88 backdrop-blur-lg border border-white/50 shadow-[0_16px_40px_rgba(0,6,19,0.1)] p-6 space-y-2">
            <p class="text-[11px] uppercase tracking-[0.18em] text-secondary font-bold">{{ $copy['hero_kicker'] }}</p>
            <p class="text-base leading-relaxed text-primary/90 font-medium">
              {{ $lang === 'en' ? 'A calm gateway to catalog, collections, and core services.' : ($lang === 'kk' ? 'Каталогқа, жинақтарға және негізгі сервістерге арналған тыныш кіру нүктесі.' : 'Спокойная точка доступа к каталогу, коллекциям и ключевым сервисам.') }}
            </p>
          </div>

          {{-- Premium Stats Card (bottom) --}}
          <div data-test-id="homepage-canonical-hero-stats"
               class="homepage-canonical__stats-card absolute bottom-8 left-8 right-8 bg-white/90 backdrop-blur-xl p-7 rounded-2xl shadow-[0_20px_60px_rgba(0,6,19,0.14)] border border-white/50">
            <div class="grid grid-cols-2 gap-8">
              <div class="flex flex-col items-start">
                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold mb-3">
                  {{ $copy['stats_archives_label'] }}
                </p>
                <p class="text-3xl font-bold text-primary">{{ $copy['stats_archives_value'] }}</p>
              </div>
              <div class="flex flex-col items-start border-l border-outline/20 pl-8">
                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold mb-3">
                  {{ $copy['stats_scholars_label'] }}
                </p>
                <p class="text-3xl font-bold text-primary">{{ $copy['stats_scholars_value'] }}</p>
              </div>
            </div>
          </div>

        </div>{{-- /right --}}

      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════════════
       SECTION 2 — CURATED COLLECTIONS BENTO
       ════════════════════════════════════════════════════════════ --}}
  <section data-section="homepage-canonical-collections"
           class="w-full max-w-7xl mx-auto px-6 md:px-12 py-16 mb-20">

    <div class="flex justify-between items-end mb-12">
      <div>
        <h2 data-test-id="homepage-canonical-collections-heading"
            class="text-[1.75rem] font-headline text-primary mb-2">
          {{ $copy['collections_heading'] }}
        </h2>
        <p class="text-on-surface-variant">{{ $copy['collections_lead'] }}</p>
      </div>
      <a href="{{ $withLang('/discover') }}"
         class="hidden md:flex items-center text-secondary font-medium hover:text-secondary-container transition-colors group">
        {{ $copy['collections_all_cta'] }}
        <span class="material-symbols-outlined ml-2 group-hover:translate-x-1 transition-transform">arrow_forward</span>
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto md:h-150">

      {{-- Large featured tile --}}
      <a href="{{ $withLang('/discover') }}"
         data-test-id="homepage-canonical-bento-featured"
         class="homepage-canonical__bento-tile md:col-span-2 md:row-span-2 relative rounded-2xl overflow-hidden group bg-surface-container-low transition-transform duration-500 block min-h-125 md:min-h-152">
        <img src="/images/news/campus-library.jpg"
             alt="{{ $copy['collection_featured_img_alt'] }}"
             class="homepage-canonical__bento-img absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        <div class="absolute inset-0 bg-linear-to-t from-primary/50 via-primary/15 to-transparent"></div>
        <div class="absolute top-6 left-6 inline-flex items-center gap-2 rounded-full bg-white/88 backdrop-blur-md px-3 py-1.5 text-xs font-semibold text-secondary shadow-[0_10px_28px_rgba(0,6,19,0.12)]">
          <span class="material-symbols-outlined text-[16px]">collections_bookmark</span>
          {{ $copy['collection_featured_badge'] }}
        </div>
        <div class="absolute bottom-0 left-0 p-8 w-full">
          <span class="inline-block px-3 py-1 bg-secondary/20 backdrop-blur-md text-on-secondary rounded-full text-xs font-semibold tracking-wide uppercase mb-4 border border-secondary/30">
            {{ $copy['collection_featured_badge'] }}
          </span>
          <h3 class="text-[1.75rem] font-headline text-surface-container-lowest mb-3">
            {{ $copy['collection_featured_title'] }}
          </h3>
          <p class="text-surface-variant text-sm max-w-md mb-6 opacity-90 line-clamp-3">
            {{ $copy['collection_featured_body'] }}
          </p>
          <span class="inline-block bg-surface-container-lowest text-primary px-5 py-2.5 rounded-lg font-medium text-sm hover:bg-surface-variant transition-colors">
            {{ $copy['collection_featured_cta'] }}
          </span>
        </div>
      </a>

      {{-- Small tile 1 — Applied Sciences / UDC 5 --}}
      <a href="{{ $withLang('/catalog', ['udc' => '5']) }}"
        data-test-id="homepage-canonical-bento-tile-1"
         class="homepage-canonical__bento-tile relative rounded-2xl overflow-hidden group bg-surface-container-low transition-transform duration-500 h-72 md:min-h-72 block">
        <img src="/images/news/ai-workshop.jpg"
             alt="{{ $copy['collection_tile1_img_alt'] }}"
             class="homepage-canonical__bento-img absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        <div class="absolute inset-0 bg-linear-to-t from-primary/45 to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-6 w-full">
          <h4 class="font-headline text-surface-container-lowest mb-2 text-lg">
            {{ $copy['collection_tile1_title'] }}
          </h4>
          <p class="text-surface-variant text-sm line-clamp-2">{{ $copy['collection_tile1_body'] }}</p>
        </div>
      </a>

      {{-- Small tile 2 — Economics & Law / UDC 33 --}}
      <a href="{{ $withLang('/catalog', ['udc' => '33']) }}"
        data-test-id="homepage-canonical-bento-tile-2"
         class="homepage-canonical__bento-tile relative rounded-2xl overflow-hidden group bg-surface-container-low transition-transform duration-500 h-72 md:min-h-72 block">
        <img src="/images/news/classics-event.jpg"
             alt="{{ $copy['collection_tile2_img_alt'] }}"
             class="homepage-canonical__bento-img absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        <div class="absolute inset-0 bg-linear-to-t from-primary/45 to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-6 w-full">
          <h4 class="font-headline text-surface-container-lowest mb-2 text-lg">
            {{ $copy['collection_tile2_title'] }}
          </h4>
          <p class="text-surface-variant text-sm line-clamp-2">{{ $copy['collection_tile2_body'] }}</p>
        </div>
      </a>

    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════════════
       SECTION 3 — SCHOLARLY SERVICES
       ════════════════════════════════════════════════════════════ --}}
  <section data-section="homepage-canonical-services"
           class="w-full bg-surface-container-low py-24 mb-20">
    <div class="max-w-7xl mx-auto px-6 md:px-12">

      <div class="text-center mb-16 max-w-2xl mx-auto">
        <h2 data-test-id="homepage-canonical-services-heading"
            class="text-[1.75rem] font-headline text-primary mb-4">
          {{ $copy['services_heading'] }}
        </h2>
        <p class="text-on-surface-variant">{{ $copy['services_lead'] }}</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($copy['services'] as $i => $service)
          <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-[0_4px_24px_rgb(0,0,0,0.02)] hover:bg-surface-container-high transition-colors duration-300">
            <div class="w-12 h-12 {{ $serviceIconBg[$i] }} rounded-xl flex items-center justify-center mb-6">
              <span class="material-symbols-outlined">{{ $service['icon'] }}</span>
            </div>
            <h3 class="text-lg font-semibold text-primary mb-3">{{ $service['title'] }}</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed mb-6">{{ $service['body'] }}</p>
            <a href="{{ $serviceHrefs[$i] }}"
               class="text-secondary font-medium text-sm flex items-center group">
              {{ $service['cta'] }}
              <span class="material-symbols-outlined text-[18px] ml-1 group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
            </a>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <section data-section="homepage-canonical-gateway"
           class="w-full max-w-7xl mx-auto px-6 md:px-12 pb-24">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
      <div class="max-w-3xl">
        <span class="text-xs uppercase tracking-[0.2em] text-secondary font-semibold">{{ $copy['gateway_meta'] }}</span>
        <h2 class="text-[1.75rem] font-headline text-primary mt-3 mb-3">{{ $copy['gateway_heading'] }}</h2>
        <p class="text-on-surface-variant">{{ $copy['gateway_lead'] }}</p>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
      @foreach($gatewayLinks as $index => $link)
        @php($meta = $gatewayMeta[$index])
        <a href="{{ $link['href'] }}"
           class="homepage-canonical__gateway-card group relative overflow-hidden rounded-2xl border border-outline-variant/20 bg-surface-container-lowest/90 px-5 py-5 text-left shadow-[0_12px_32px_rgba(0,6,19,0.06)] transition-all duration-200 hover:-translate-y-1 hover:border-secondary/30 hover:shadow-[0_18px_44px_rgba(0,6,19,0.12)]">
          <span class="absolute inset-x-0 top-0 h-1 bg-linear-to-r from-secondary via-primary to-tertiary opacity-80"></span>
          <span class="absolute -right-4 -top-4 h-20 w-20 rounded-full bg-secondary/10 blur-2xl transition-transform duration-300 group-hover:scale-125"></span>
          <span class="relative z-10 flex items-start gap-4">
            <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $meta['tone'] }} shadow-[0_8px_24px_rgba(0,6,19,0.08)]">
              <span class="material-symbols-outlined text-[20px]">{{ $meta['icon'] }}</span>
            </span>
            <span class="min-w-0 flex-1">
              <span class="block text-[11px] uppercase tracking-[0.2em] text-secondary font-semibold mb-1">{{ $meta['subtitle'] }}</span>
              <span class="flex items-center justify-between gap-3">
                <span class="font-semibold text-primary leading-tight">{{ $link['label'] }}</span>
                <span class="material-symbols-outlined text-[18px] text-secondary transition-transform duration-200 group-hover:translate-x-1">arrow_outward</span>
              </span>
            </span>
          </span>
        </a>
      @endforeach
    </div>
  </section>

  <section data-section="homepage-canonical-hub-slices"
           class="w-full max-w-7xl mx-auto px-6 md:px-12 pb-24">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
      <div class="max-w-3xl">
        <span class="text-xs uppercase tracking-[0.2em] text-secondary font-semibold">{{ $lang === 'ru' ? 'Публичные разделы' : ($lang === 'kk' ? 'Қоғамдық бөлімдер' : 'Public sections') }}</span>
        <h2 class="text-[1.75rem] font-headline text-primary mt-3 mb-3">{{ $lang === 'ru' ? 'Институциональные срезы' : ($lang === 'kk' ? 'Институционалдық срездер' : 'Institutional slices') }}</h2>
        <p class="text-on-surface-variant">{{ $lang === 'ru' ? 'Короткие ориентиры по ключевым страницам библиотеки.' : ($lang === 'kk' ? 'Кітапхананың негізгі беттері бойынша қысқа бағдарлар.' : 'Short pointers to the library pages readers use most.') }}</p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
      @foreach(['about', 'leadership', 'rules', 'contacts'] as $slug)
        @php($card = $hubCards[$slug])
        @php($cardImage = $hubImages[$slug])
        <a href="{{ $card['href'] }}" class="homepage-canonical__hub-card block overflow-hidden rounded-2xl bg-surface-container-lowest shadow-[0_16px_40px_rgba(0,6,19,0.08)] border border-outline-variant/20 hover:border-secondary/30 hover:shadow-[0_22px_52px_rgba(0,6,19,0.12)] transition-all duration-200">
          <div class="relative h-44 overflow-hidden">
            <img src="{{ $cardImage['src'] }}" alt="{{ $cardImage['alt'] }}" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-linear-to-t from-primary/50 via-primary/10 to-transparent"></div>
            <div class="absolute top-4 left-4 w-11 h-11 rounded-xl flex items-center justify-center bg-white/88 backdrop-blur-md text-secondary shadow-[0_10px_28px_rgba(0,6,19,0.12)]">
              <span class="material-symbols-outlined text-[20px]">{{ $card['icon'] }}</span>
            </div>
          </div>
          <div class="p-6">
            <p class="text-xs uppercase tracking-[0.18em] text-secondary font-semibold mb-2">{{ $card['eyebrow'] }}</p>
            <h3 class="font-headline text-lg text-primary mb-3">{{ $card['title'] }}</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed mb-5">{{ $card['body'] }}</p>
            <span class="inline-flex items-center gap-2 text-sm font-medium text-secondary">
              {{ $card['cta'] }}
              <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </span>
          </div>
        </a>
      @endforeach
    </div>
  </section>

  <section data-section="homepage-canonical-updates"
           class="w-full max-w-7xl mx-auto px-6 md:px-12 pb-28">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
      <div class="max-w-3xl">
        <span class="text-xs uppercase tracking-[0.2em] text-secondary font-semibold">{{ $lang === 'ru' ? 'Новости и события' : ($lang === 'kk' ? 'Жаңалықтар мен іс-шаралар' : 'News & events') }}</span>
        <h2 class="text-[1.75rem] font-headline text-primary mt-3 mb-3">{{ $lang === 'ru' ? 'Последние обновления' : ($lang === 'kk' ? 'Соңғы жаңартулар' : 'Latest updates') }}</h2>
        <p class="text-on-surface-variant">{{ $lang === 'ru' ? 'Краткие анонсы из разделов новостей и событий библиотеки.' : ($lang === 'kk' ? 'Кітапхананың жаңалықтар мен іс-шаралар бөлімдерінен қысқа анонстар.' : 'Concise previews from the library news and events sections.') }}</p>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      @foreach(['news', 'events'] as $slug)
        @php($card = $hubCards[$slug])
        @php($cardImage = $hubImages[$slug])
        <a href="{{ $card['href'] }}" class="homepage-canonical__update-card block overflow-hidden rounded-2xl bg-surface-container-low shadow-[0_16px_40px_rgba(0,6,19,0.08)] border border-outline-variant/20 hover:border-secondary/30 hover:shadow-[0_22px_52px_rgba(0,6,19,0.12)] transition-all duration-200">
          <div class="relative h-56 overflow-hidden">
            <img src="{{ $cardImage['src'] }}" alt="{{ $cardImage['alt'] }}" class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-linear-to-t from-primary/50 via-primary/12 to-transparent"></div>
            <div class="absolute top-4 left-4 inline-flex items-center gap-2 rounded-full bg-white/88 backdrop-blur-md px-3 py-1.5 text-xs font-semibold text-secondary shadow-[0_10px_28px_rgba(0,6,19,0.12)]">
              <span class="material-symbols-outlined text-[16px]">{{ $card['icon'] }}</span>
              {{ $card['meta'] }}
            </div>
          </div>
          <div class="p-7">
            <div class="flex items-start justify-between gap-4 mb-5">
              <div>
                <p class="text-xs uppercase tracking-[0.18em] text-secondary font-semibold mb-2">{{ $card['eyebrow'] }}</p>
                <h3 class="font-headline text-2xl text-primary leading-tight">{{ $card['title'] }}</h3>
              </div>
              <span class="material-symbols-outlined text-secondary text-[28px] mt-1">{{ $card['icon'] }}</span>
            </div>
            <p class="text-on-surface-variant text-sm leading-relaxed mb-4">{{ $card['body'] }}</p>
            <span class="inline-flex items-center gap-2 text-sm font-medium text-secondary">
              {{ $card['cta'] }}
              <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </span>
          </div>
        </a>
      @endforeach
    </div>
  </section>

</div>{{-- /homepage-canonical-page --}}
@endsection
