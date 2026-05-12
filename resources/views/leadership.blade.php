@extends('layouts.public')

@php
  $lang = request()->query('lang', 'ru');
  $lang = in_array($lang, ['kk', 'ru', 'en'], true) ? $lang : 'ru';
  $activePage = $activePage ?? 'leadership';

  $routeWithLang = static function (string $path, array $query = []) use ($lang): string {
      if ($lang !== 'ru' && ! array_key_exists('lang', $query)) {
          $query['lang'] = $lang;
      }
      $qs = http_build_query(array_filter($query, static fn ($v) => $v !== null && $v !== ''));
      return $path . ($qs !== '' ? ('?' . $qs) : '');
  };

  $copy = [
      'ru' => [
          'title' => 'Руководство — KazUTB Smart Library',
          'hero_title' => 'Руководство библиотеки',
          'hero_lead' => 'Руководство библиотеки координирует академические сервисы, цифровые коллекции и институциональные процессы KazUTB Smart Library.',
          'roles_title' => 'Роли и ответственность',
          'roles_lead' => 'Состав отражает закреплённые зоны ответственности. Профили команды публикуются по мере верификации кадровых данных.',
          'role_focus_label' => 'Ключевая зона',
          'contact_title' => 'Контакты и обращения',
          'contact_body' => 'Для официальных запросов, писем преподавателей и внешних академических обращений используйте маршруты ниже.',
          'contact_email_label' => 'Электронная почта',
          'contact_phone_label' => 'Телефон',
          'contact_hours_label' => 'Часы приёма',
          'contact_hours_value' => 'Пн-Пт, 09:00-18:00',
          'open_contacts' => 'Открыть страницу контактов',
          'submit_request' => 'Отправить обращение',
          'profile_cta' => 'Профиль роли',
          'modal_profile_heading' => 'Детальный профиль',
            'modal_close' => 'Закрыть',
            'modal_experience_label' => 'Опыт и академический контекст',
            'modal_email_label' => 'Электронная почта',
            'modal_phone_label' => 'Телефон',
            'modal_office_label' => 'Кабинет',
            'modal_hours_label' => 'Часы приёма',
            'modal_notes_label' => 'Примечание',
      ],
      'kk' => [
          'title' => 'Басшылық — KazUTB Smart Library',
          'hero_title' => 'Кітапхана басшылығы',
          'hero_lead' => 'Кітапхана басшылығы KazUTB Smart Library-дің академиялық сервистерін, цифрлық жинақтарын және институционалдық процестерін үйлестіреді.',
          'roles_title' => 'Рөлдер мен жауапкершілік',
          'roles_lead' => 'Құрам бекітілген жауапкершілік аймақтарын көрсетеді. Команда профильдері кадрлық деректер верификациясына қарай жарияланады.',
          'role_focus_label' => 'Негізгі аймақ',
          'contact_title' => 'Байланыс және өтініштер',
          'contact_body' => 'Ресми сұраулар, оқытушылар хаттары және сыртқы академиялық өтініштер үшін төмендегі маршруттарды пайдаланыңыз.',
          'contact_email_label' => 'Электрондық пошта',
          'contact_phone_label' => 'Телефон',
          'contact_hours_label' => 'Қабылдау уақыты',
          'contact_hours_value' => 'Дс-Жм, 09:00-18:00',
          'open_contacts' => 'Байланыс бетін ашу',
          'submit_request' => 'Өтініш жіберу',
          'profile_cta' => 'Рөл профилі',
          'modal_profile_heading' => 'Толық профиль',
            'modal_close' => 'Жабу',
            'modal_experience_label' => 'Тәжірибе және академиялық контекст',
            'modal_email_label' => 'Электрондық пошта',
            'modal_phone_label' => 'Телефон',
            'modal_office_label' => 'Кабинет',
            'modal_hours_label' => 'Қабылдау уақыты',
            'modal_notes_label' => 'Ескертпе',
      ],
      'en' => [
          'title' => 'Leadership — KazUTB Smart Library',
          'hero_title' => 'Library Leadership',
          'hero_lead' => 'Library leadership coordinates academic services, digital collections, and institutional workflows of KazUTB Smart Library.',
          'roles_title' => 'Roles and responsibilities',
          'roles_lead' => 'The directory reflects assigned responsibility areas. Team profiles are published as HR verification is completed.',
          'role_focus_label' => 'Primary focus',
          'contact_title' => 'Contact and requests',
          'contact_body' => 'For official requests, faculty letters, and external academic inquiries, use the routing paths below.',
          'contact_email_label' => 'Email',
          'contact_phone_label' => 'Phone',
          'contact_hours_label' => 'Working hours',
          'contact_hours_value' => 'Mon-Fri, 09:00-18:00',
          'open_contacts' => 'Open contacts page',
          'submit_request' => 'Submit request',
          'profile_cta' => 'Role profile',
          'modal_profile_heading' => 'Profile details',
            'modal_close' => 'Close',
            'modal_experience_label' => 'Experience and academic context',
            'modal_email_label' => 'Email',
            'modal_phone_label' => 'Phone',
            'modal_office_label' => 'Office',
            'modal_hours_label' => 'Working hours',
            'modal_notes_label' => 'Notes',
      ],
  ][$lang];

  $profiles = collect($leadership['profiles'] ?? [])->sortBy('order')->values();

  $placeholderNames = [
      'director' => [
          'ru' => 'Панкей Ж.',
          'kk' => 'Панкей Ж.',
          'en' => 'Pankey Zh.',
      ],
      'digital-collections' => [
          'ru' => 'Ибраев Р.',
          'kk' => 'Ибраев Р.',
          'en' => 'Rustam Ibrayev',
      ],
      'reader-services' => [
          'ru' => 'Оспанова Д.',
          'kk' => 'Оспанова Д.',
          'en' => 'Dinara Ospanova',
      ],
  ];

  $roleContacts = [
      'director' => ['email' => 'director.library@kazutb.kz', 'phone' => '+7 (7172) 70-20-10'],
      'digital-collections' => ['email' => 'digital.collections@kazutb.kz', 'phone' => '+7 (7172) 70-20-21'],
      'reader-services' => ['email' => 'reader.services@kazutb.kz', 'phone' => '+7 (7172) 70-20-32'],
  ];

    $profileDetails = [
      'director' => [
        'ru' => [
          'summary' => 'Общее руководство библиотекой, институциональной политикой и ключевыми академическими сервисами.',
          'experience' => 'Опыт в управлении университетскими библиотечными процессами, координации методических советов и интеграции библиотечной стратегии в академическую повестку вуза.',
          'office' => 'Административный корпус, кабинет 204',
          'hours' => 'Пн-Ср, 10:00-12:00 (по предварительной записи)',
          'notes' => 'Стратегические обращения преподавателей и официальные письма направляются через канцелярию библиотеки.',
        ],
        'kk' => [
          'summary' => 'Кітапханаға, институционалдық саясатқа және негізгі академиялық сервистерге жалпы басшылық жасайды.',
          'experience' => 'Университеттік кітапхана процестерін басқару, әдістемелік кеңестерді үйлестіру және кітапхана стратегиясын ЖОО академиялық күн тәртібіне енгізу тәжірибесі бар.',
          'office' => 'Әкімшілік корпус, 204-кабинет',
          'hours' => 'Дс-Ср, 10:00-12:00 (алдын ала жазылу бойынша)',
          'notes' => 'Оқытушылардың стратегиялық өтініштері мен ресми хаттары кітапхана кеңсесі арқылы қабылданады.',
        ],
        'en' => [
          'summary' => 'Provides overall leadership for the library, institutional policy alignment, and core academic services.',
          'experience' => 'Background in university library operations, governance committee coordination, and integration of library strategy into the academic agenda of the institution.',
          'office' => 'Administrative building, office 204',
          'hours' => 'Mon-Wed, 10:00-12:00 (by appointment)',
          'notes' => 'Strategic faculty requests and official letters are routed through the library office.',
        ],
      ],
      'digital-collections' => [
        'ru' => [
          'summary' => 'Курирует электронные коллекции, репозиторий и лицензируемые информационные ресурсы.',
          'experience' => 'Практика сопровождения цифровых библиотек, контроля метаданных и координации подписных платформ для учебных и исследовательских подразделений.',
          'office' => 'Цифровой центр, кабинет 118',
          'hours' => 'Вт-Чт, 14:00-17:00',
          'notes' => 'Консультации по удалённому доступу и репозиторию проводятся по рабочим заявкам факультетов.',
        ],
        'kk' => [
          'summary' => 'Электрондық жинақтарды, репозиторийді және лицензияланған ақпараттық ресурстарды үйлестіреді.',
          'experience' => 'Цифрлық кітапханаларды сүйемелдеу, метадеректі бақылау және оқу мен зерттеу бөлімдеріне жазылым платформаларын үйлестіру тәжірибесі.',
          'office' => 'Цифрлық орталық, 118-кабинет',
          'hours' => 'Сс-Бс, 14:00-17:00',
          'notes' => 'Қашықтан қолжетімділік пен репозиторий бойынша кеңестер факультет өтінімдері арқылы жүргізіледі.',
        ],
        'en' => [
          'summary' => 'Oversees digital collections, repository workflows, and licensed information resources.',
          'experience' => 'Experience supporting digital library operations, metadata quality controls, and subscription platform coordination for teaching and research units.',
          'office' => 'Digital center, office 118',
          'hours' => 'Tue-Thu, 14:00-17:00',
          'notes' => 'Consultations on remote access and repository routing are handled through faculty service requests.',
        ],
      ],
      'reader-services' => [
        'ru' => [
          'summary' => 'Отвечает за читательские маршруты: выдачу, возврат, подборки и сервис сопровождения.',
          'experience' => 'Опыт организации фронт-офисных библиотечных процессов, координации консультаций и поддержки академических пользователей в ежедневной работе с фондом.',
          'office' => 'Зал обслуживания, стойка 1',
          'hours' => 'Пн-Пт, 09:00-18:00',
          'notes' => 'Приоритет: обращения по доступности изданий, срокам возврата и маршрутам консультации с библиотекарем.',
        ],
        'kk' => [
          'summary' => 'Оқырман маршруттарына жауап береді: беру, қайтару, іріктемелер және сүйемелдеу сервистері.',
          'experience' => 'Фронт-офис кітапхана процестерін ұйымдастыру, консультацияларды үйлестіру және академиялық пайдаланушыларды қормен күнделікті жұмысында қолдау тәжірибесі бар.',
          'office' => 'Қызмет көрсету залы, 1-стойка',
          'hours' => 'Дс-Жм, 09:00-18:00',
          'notes' => 'Басым бағыт: басылым қолжетімділігі, қайтару мерзімдері және кітапханашы кеңесіне маршруттау.',
        ],
        'en' => [
          'summary' => 'Responsible for reader workflows: circulation, returns, shortlists, and service guidance.',
          'experience' => 'Experience in front-desk library operations, consultation coordination, and day-to-day support for academic users working with the collection.',
          'office' => 'Reader service hall, desk 1',
          'hours' => 'Mon-Fri, 09:00-18:00',
          'notes' => 'Priority routes include item availability, return timelines, and consultation routing to librarians.',
        ],
      ],
    ];

  $profilesForView = $profiles->map(function (array $profile) use ($lang, $placeholderNames, $roleContacts) {
      $slug = (string) ($profile['slug'] ?? '');

      return [
          'slug' => $slug,
          'name' => $profile['full_name'][$lang] ?? ($placeholderNames[$slug][$lang] ?? null),
          'role_title' => $profile['role_title'][$lang] ?? '',
          'role_scope' => $profile['role_scope_line'][$lang] ?? '',
          'description' => $profile['role_description'][$lang] ?? '',
          'initials' => $profile['portrait_initials'][$lang] ?? mb_strtoupper((string) mb_substr((string) ($profile['role_title'][$lang] ?? 'L'), 0, 1)),
          'email' => $roleContacts[$slug]['email'] ?? null,
          'phone' => $roleContacts[$slug]['phone'] ?? null,
      ];
  })->values();

        $profilesForView = $profilesForView->map(function (array $profile) use ($profileDetails, $lang) {
          $details = $profileDetails[$profile['slug']][$lang] ?? [
            'summary' => $profile['description'],
            'experience' => '',
            'office' => '',
            'hours' => '',
            'notes' => '',
          ];

          return array_merge($profile, $details);
        })->values();

  $contactEmail = 'library@kazutb.kz';
  $contactPhone = '+7 (7172) 70-20-00';
@endphp

@section('title', $copy['title'])

@section('content')
  <section class="leadership-canonical" data-page="leadership-canonical">
    <header class="leadership-canonical__hero">
      <h1 class="leadership-canonical__display">{{ $copy['hero_title'] }}</h1>
      <p class="leadership-canonical__lead">{{ $copy['hero_lead'] }}</p>
    </header>

    <section class="leadership-canonical__composition" aria-label="Leadership composition">
      <div class="leadership-canonical__grid" role="list">
        @foreach($profilesForView as $item)
          <article class="leadership-canonical__card" role="listitem" data-leadership-role="{{ $item['slug'] }}">
            <div class="leadership-canonical__avatar" aria-hidden="true">
              <span>{{ $item['initials'] }}</span>
            </div>

            <div class="leadership-canonical__card-body">
              @if($item['name'])
                <h2 class="leadership-canonical__name">{{ $item['name'] }}</h2>
              @endif
              <p class="leadership-canonical__role">{{ $item['role_title'] }}</p>
              <p class="leadership-canonical__description">{{ $item['description'] }}</p>

              <div class="leadership-canonical__divider"></div>

              <button
                type="button"
                class="leadership-canonical__profile-link"
                data-profile-open
                data-profile-id="{{ $item['slug'] }}"
                aria-haspopup="dialog"
                aria-controls="leadership-profile-modal"
              >
                <span>{{ $copy['profile_cta'] }}</span>
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
              </button>
            </div>
          </article>
        @endforeach
      </div>
    </section>

    <section class="leadership-canonical__roles" data-section="roles-responsibilities">
      <h2 class="leadership-canonical__section-title">{{ $copy['roles_title'] }}</h2>
      <p class="leadership-canonical__section-lead">{{ $copy['roles_lead'] }}</p>

      <div class="leadership-canonical__role-list">
        @foreach($profilesForView as $item)
          <article class="leadership-canonical__role-item">
            <h3>{{ $item['role_title'] }}</h3>
            <p><strong>{{ $copy['role_focus_label'] }}:</strong> {{ $item['role_scope'] }}</p>
            @if($item['email'])
              <p><a href="mailto:{{ $item['email'] }}">{{ $item['email'] }}</a></p>
            @endif
          </article>
        @endforeach
      </div>
    </section>

    <section class="leadership-canonical__contact" data-section="contact-request">
      <h2 class="leadership-canonical__section-title">{{ $copy['contact_title'] }}</h2>
      <p class="leadership-canonical__section-lead">{{ $copy['contact_body'] }}</p>

      <dl class="leadership-canonical__contact-list">
        <div>
          <dt>{{ $copy['contact_email_label'] }}</dt>
          <dd><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></dd>
        </div>
        <div>
          <dt>{{ $copy['contact_phone_label'] }}</dt>
          <dd><a href="tel:+77172702000">{{ $contactPhone }}</a></dd>
        </div>
        <div>
          <dt>{{ $copy['contact_hours_label'] }}</dt>
          <dd>{{ $copy['contact_hours_value'] }}</dd>
        </div>
      </dl>

      <div class="leadership-canonical__contact-actions">
        <a class="leadership-canonical__btn leadership-canonical__btn--primary" href="{{ $routeWithLang('/contacts') }}">{{ $copy['open_contacts'] }}</a>
        <a class="leadership-canonical__btn leadership-canonical__btn--ghost" href="{{ $routeWithLang('/contacts') }}">{{ $copy['submit_request'] }}</a>
      </div>
    </section>

    <div class="leadership-modal" id="leadership-profile-modal" hidden>
      <div class="leadership-modal__backdrop" data-profile-close></div>
      <section class="leadership-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="leadership-modal-title">
        <button type="button" class="leadership-modal__close" data-profile-close aria-label="{{ $copy['modal_close'] }}">
          <span class="material-symbols-outlined" aria-hidden="true">close</span>
        </button>

        <header class="leadership-modal__header">
          <p class="leadership-modal__eyebrow">{{ $copy['modal_profile_heading'] }}</p>
          <h2 class="leadership-modal__name" id="leadership-modal-title"></h2>
          <p class="leadership-modal__role" id="leadership-modal-role"></p>
          <p class="leadership-modal__summary" id="leadership-modal-summary"></p>
        </header>

        <div class="leadership-modal__content">
          <div class="leadership-modal__block">
            <h3>{{ $copy['modal_experience_label'] }}</h3>
            <p id="leadership-modal-experience"></p>
          </div>

          <dl class="leadership-modal__meta">
            <h3 class="leadership-modal__meta-title">{{ $copy['contact_title'] }}</h3>
            <div>
              <dt>{{ $copy['modal_email_label'] }}</dt>
              <dd id="leadership-modal-email"></dd>
            </div>
            <div>
              <dt>{{ $copy['modal_phone_label'] }}</dt>
              <dd id="leadership-modal-phone"></dd>
            </div>
            <div>
              <dt>{{ $copy['modal_office_label'] }}</dt>
              <dd id="leadership-modal-office"></dd>
            </div>
            <div>
              <dt>{{ $copy['modal_hours_label'] }}</dt>
              <dd id="leadership-modal-hours"></dd>
            </div>
          </dl>

          <div class="leadership-modal__block">
            <h3>{{ $copy['modal_notes_label'] }}</h3>
            <p id="leadership-modal-notes"></p>
          </div>
        </div>
      </section>
    </div>
  </section>
@endsection

@section('head')
<style>
  .leadership-canonical {
    max-width: 1280px;
    margin: 0 auto;
    padding: 96px 24px 104px;
    color: #191c1d;
    font-family: 'Manrope', sans-serif;
  }

  .leadership-canonical__hero {
    max-width: 920px;
    margin: 0 0 100px;
  }

  .leadership-canonical__display {
    margin: 0 0 26px;
    font-family: 'Newsreader', serif;
    font-size: clamp(48px, 6.4vw, 76px);
    line-height: 1.04;
    letter-spacing: -0.03em;
    color: #000613;
  }

  .leadership-canonical__lead {
    margin: 0;
    max-width: 880px;
    font-size: clamp(20px, 2.1vw, 42px);
    line-height: 1.42;
    color: #2d323a;
    font-weight: 400;
  }

  .leadership-canonical__composition {
    padding-top: 34px;
    margin-bottom: 88px;
  }

  .leadership-canonical__grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 56px;
  }

  .leadership-canonical__card {
    position: relative;
    background: #f3f4f5;
    border-radius: 12px;
    min-height: 560px;
    padding: 0 40px 40px;
  }

  .leadership-canonical__avatar {
    width: 160px;
    height: 160px;
    margin: -76px auto 24px;
    border-radius: 14px;
    border: 2px solid rgba(255, 255, 255, 0.7);
    background: linear-gradient(145deg, #2f333a, #111318);
    box-shadow: 0 10px 20px rgba(0, 6, 19, 0.14);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .leadership-canonical__avatar span {
    font-family: 'Newsreader', serif;
    font-size: 46px;
    line-height: 1;
    color: #f8f9fa;
  }

  .leadership-canonical__card-body {
    display: flex;
    flex-direction: column;
    height: calc(100% - 108px);
  }

  .leadership-canonical__name {
    margin: 0 0 4px;
    font-family: 'Newsreader', serif;
    font-size: clamp(38px, 2.2vw, 50px);
    line-height: 1.08;
    letter-spacing: -0.02em;
    color: #000613;
  }

  .leadership-canonical__role {
    margin: 0 0 30px;
    font-size: 14px;
    line-height: 1.35;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #006a6a;
    font-weight: 700;
  }

  .leadership-canonical__description {
    margin: 0;
    font-size: 18px;
    line-height: 1.6;
    color: #2f333a;
  }

  .leadership-canonical__divider {
    margin-top: auto;
    margin-bottom: 28px;
    height: 1px;
    background: rgba(196, 198, 207, 0.7);
  }

  .leadership-canonical__profile-link {
    appearance: none;
    background: transparent;
    border: 0;
    padding: 0;
    text-align: left;
    cursor: pointer;
    color: #1f2733;
    text-decoration: none;
    font-size: 15px;
    line-height: 1;
    font-weight: 600;
    letter-spacing: 0.02em;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    align-self: flex-start;
    min-height: 40px;
    padding: 0 14px;
    border-radius: 999px;
    border: 1px solid rgba(116, 119, 127, 0.28);
    background: rgba(255, 255, 255, 0.9);
    transition: color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
  }

  .leadership-canonical__profile-link:hover {
    color: #006a6a;
    border-color: rgba(0, 106, 106, 0.42);
    background: #ffffff;
    box-shadow: 0 8px 18px rgba(0, 6, 19, 0.08);
  }

  .leadership-canonical__profile-link:focus-visible {
    outline: none;
    border-color: #006a6a;
    box-shadow: 0 0 0 3px rgba(0, 106, 106, 0.18);
  }

  .leadership-modal[hidden] {
    display: none;
  }

  .leadership-modal {
    position: fixed;
    inset: 0;
    z-index: 120;
    display: grid;
    align-items: center;
    justify-items: center;
    padding: 18px;
  }

  .leadership-modal__backdrop {
    position: absolute;
    inset: 0;
    z-index: 0;
    background: radial-gradient(circle at 50% 20%, rgba(0, 31, 63, 0.18), rgba(0, 6, 19, 0.52));
    backdrop-filter: blur(3px);
  }

  .leadership-modal__dialog {
    position: relative;
    z-index: 1;
    width: min(760px, 100%);
    max-height: min(92vh, 860px);
    overflow: auto;
    background: #f8f9fa;
    border-radius: 16px;
    box-shadow: 0 22px 56px rgba(0, 6, 19, 0.22);
    border: 1px solid rgba(196, 198, 207, 0.45);
    padding: 24px;
  }

  .leadership-modal__close {
    appearance: none;
    border: 0;
    background: #ffffff;
    width: 40px;
    height: 40px;
    border-radius: 999px;
    cursor: pointer;
    color: #1f2733;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 6, 19, 0.12);
    position: absolute;
    right: 14px;
    top: 14px;
  }

  .leadership-modal__close:hover {
    color: #006a6a;
  }

  .leadership-modal__header {
    padding-right: 52px;
    margin-bottom: 18px;
    border-bottom: 1px solid rgba(196, 198, 207, 0.5);
    padding-bottom: 16px;
  }

  .leadership-modal__eyebrow {
    margin: 0 0 6px;
    font-size: 11px;
    line-height: 1.3;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #006a6a;
    font-weight: 700;
  }

  .leadership-modal__name {
    margin: 0 0 6px;
    font-family: 'Newsreader', serif;
    font-size: clamp(36px, 4.1vw, 50px);
    line-height: 1.08;
    letter-spacing: -0.02em;
    color: #000613;
  }

  .leadership-modal__role {
    margin: 0 0 14px;
    display: inline-flex;
    align-items: center;
    min-height: 28px;
    padding: 0 10px;
    border-radius: 999px;
    font-size: 12px;
    line-height: 1;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #006a6a;
    font-weight: 700;
    background: rgba(0, 106, 106, 0.1);
  }

  .leadership-modal__summary {
    margin: 0;
    font-size: 17px;
    line-height: 1.6;
    color: #2f333a;
  }

  .leadership-modal__content {
    display: grid;
    gap: 14px;
  }

  .leadership-modal__block,
  .leadership-modal__meta {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 8px 18px rgba(0, 6, 19, 0.05);
    border: 1px solid rgba(196, 198, 207, 0.28);
  }

  .leadership-modal__block h3 {
    margin: 0 0 7px;
    font-family: 'Newsreader', serif;
    font-size: 24px;
    line-height: 1.2;
    color: #000613;
  }

  .leadership-modal__block p {
    margin: 0;
    font-size: 15px;
    line-height: 1.6;
    color: #43474e;
  }

  .leadership-modal__meta {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    align-items: start;
    gap: 14px;
  }

  .leadership-modal__meta-title {
    margin: 0;
    grid-column: 1 / -1;
    font-family: 'Newsreader', serif;
    font-size: 24px;
    line-height: 1.2;
    color: #000613;
  }

  .leadership-modal__meta dt {
    margin: 0 0 4px;
    font-size: 12px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #006a6a;
    font-weight: 700;
  }

  .leadership-modal__meta dd,
  .leadership-modal__meta dd a {
    margin: 0;
    font-size: 15px;
    line-height: 1.5;
    color: #1f2733;
    text-decoration: none;
  }

  .leadership-modal__meta dd a:hover {
    color: #006a6a;
  }

  body.leadership-modal-open {
    overflow: hidden;
  }

  .leadership-canonical__roles,
  .leadership-canonical__contact {
    background: #f3f4f5;
    border-radius: 12px;
    padding: 36px 32px;
    margin-bottom: 32px;
  }

  .leadership-canonical__section-title {
    margin: 0 0 12px;
    font-family: 'Newsreader', serif;
    font-size: 40px;
    line-height: 1.1;
    letter-spacing: -0.02em;
    color: #000613;
  }

  .leadership-canonical__section-lead {
    margin: 0 0 24px;
    font-size: 18px;
    line-height: 1.6;
    color: #43474e;
    max-width: 900px;
  }

  .leadership-canonical__role-list {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
  }

  .leadership-canonical__role-item {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 8px 22px rgba(0, 6, 19, 0.05);
  }

  .leadership-canonical__role-item h3 {
    margin: 0 0 10px;
    font-family: 'Newsreader', serif;
    font-size: 26px;
    line-height: 1.2;
    color: #000613;
  }

  .leadership-canonical__role-item p {
    margin: 0 0 8px;
    font-size: 16px;
    line-height: 1.5;
    color: #43474e;
  }

  .leadership-canonical__role-item a {
    color: #006a6a;
    text-decoration: none;
  }

  .leadership-canonical__role-item a:hover {
    text-decoration: underline;
  }

  .leadership-canonical__contact-list {
    margin: 0 0 26px;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
  }

  .leadership-canonical__contact-list dt {
    margin: 0 0 6px;
    font-size: 12px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #006a6a;
    font-weight: 700;
  }

  .leadership-canonical__contact-list dd {
    margin: 0;
    font-size: 18px;
    line-height: 1.4;
    color: #1f2733;
  }

  .leadership-canonical__contact-list a {
    color: #1f2733;
    text-decoration: none;
  }

  .leadership-canonical__contact-list a:hover {
    color: #006a6a;
  }

  .leadership-canonical__contact-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .leadership-canonical__btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 44px;
    padding: 0 18px;
    border-radius: 8px;
    font-size: 15px;
    line-height: 1;
    text-decoration: none;
    transition: 0.22s ease;
  }

  .leadership-canonical__btn--primary {
    background: linear-gradient(90deg, #000613 0%, #001f3f 100%);
    color: #ffffff;
  }

  .leadership-canonical__btn--primary:hover {
    opacity: 0.9;
  }

  .leadership-canonical__btn--ghost {
    color: #1f2733;
    border: 1px solid rgba(116, 119, 127, 0.3);
    background: #ffffff;
  }

  .leadership-canonical__btn--ghost:hover {
    border-color: rgba(0, 106, 106, 0.45);
    color: #006a6a;
  }

  @media (max-width: 1220px) {
    .leadership-canonical__grid,
    .leadership-canonical__role-list,
    .leadership-canonical__contact-list {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

  @media (max-width: 860px) {
    .leadership-canonical {
      padding: 84px 16px 96px;
    }

    .leadership-canonical__hero {
      margin-bottom: 76px;
    }

    .leadership-canonical__grid,
    .leadership-canonical__role-list,
    .leadership-canonical__contact-list {
      grid-template-columns: 1fr;
    }

    .leadership-canonical__composition {
      padding-top: 24px;
    }

    .leadership-canonical__card {
      min-height: 0;
      padding: 0 24px 26px;
    }

    .leadership-canonical__avatar {
      width: 136px;
      height: 136px;
      margin-top: -62px;
      margin-bottom: 18px;
    }

    .leadership-canonical__name {
      font-size: clamp(30px, 8vw, 42px);
    }

    .leadership-canonical__section-title {
      font-size: 34px;
    }

    .leadership-modal__meta {
      grid-template-columns: 1fr;
    }

    .leadership-modal {
      padding: 10px;
      align-items: end;
    }

    .leadership-modal__dialog {
      width: 100%;
      max-height: 88vh;
      border-radius: 14px 14px 0 0;
      padding: 18px 16px 18px;
    }

    .leadership-modal__close {
      right: 10px;
      top: 10px;
      width: 38px;
      height: 38px;
    }

    .leadership-modal__header {
      padding-right: 44px;
      margin-bottom: 14px;
      padding-bottom: 12px;
    }

    .leadership-modal__summary {
      font-size: 16px;
    }

    .leadership-modal__block h3,
    .leadership-modal__meta-title {
      font-size: 22px;
    }
  }
</style>
@endsection

@section('scripts')
<script>
  (() => {
    const profiles = @json($profilesForView);
    const profileMap = new Map(profiles.map((profile) => [profile.slug, profile]));

    const modal = document.getElementById('leadership-profile-modal');
    if (!modal) {
      return;
    }

    const titleEl = document.getElementById('leadership-modal-title');
    const roleEl = document.getElementById('leadership-modal-role');
    const summaryEl = document.getElementById('leadership-modal-summary');
    const experienceEl = document.getElementById('leadership-modal-experience');
    const emailEl = document.getElementById('leadership-modal-email');
    const phoneEl = document.getElementById('leadership-modal-phone');
    const officeEl = document.getElementById('leadership-modal-office');
    const hoursEl = document.getElementById('leadership-modal-hours');
    const notesEl = document.getElementById('leadership-modal-notes');
    const closeNodes = modal.querySelectorAll('[data-profile-close]');

    let lastTrigger = null;

    const setContact = (node, value, type) => {
      if (!node) {
        return;
      }

      if (!value) {
        node.textContent = '-';
        return;
      }

      if (type === 'email') {
        node.innerHTML = '<a href="mailto:' + value + '">' + value + '</a>';
        return;
      }

      if (type === 'phone') {
        const dial = value.replace(/[^+\d]/g, '');
        node.innerHTML = '<a href="tel:' + dial + '">' + value + '</a>';
        return;
      }

      node.textContent = value;
    };

    const openModal = (slug, trigger) => {
      const profile = profileMap.get(slug);
      if (!profile) {
        return;
      }

      lastTrigger = trigger || null;

      if (titleEl) titleEl.textContent = profile.name || '';
      if (roleEl) roleEl.textContent = profile.role_title || '';
      if (summaryEl) summaryEl.textContent = profile.summary || '';
      if (experienceEl) experienceEl.textContent = profile.experience || '';
      setContact(emailEl, profile.email || '', 'email');
      setContact(phoneEl, profile.phone || '', 'phone');
      setContact(officeEl, profile.office || '', 'text');
      setContact(hoursEl, profile.hours || '', 'text');
      if (notesEl) notesEl.textContent = profile.notes || '';

      modal.hidden = false;
      document.body.classList.add('leadership-modal-open');
      modal.querySelector('.leadership-modal__close')?.focus();
    };

    const closeModal = () => {
      modal.hidden = true;
      document.body.classList.remove('leadership-modal-open');
      if (lastTrigger) {
        lastTrigger.focus();
      }
    };

    document.querySelectorAll('[data-profile-open]').forEach((button) => {
      button.addEventListener('click', () => {
        openModal(button.dataset.profileId, button);
      });
    });

    closeNodes.forEach((node) => {
      node.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', (event) => {
      const dialog = modal.querySelector('.leadership-modal__dialog');
      if (!dialog) {
        return;
      }

      if (event.target === modal || !dialog.contains(event.target)) {
        closeModal();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && !modal.hidden) {
        closeModal();
      }
    });
  })();
</script>
@endsection
