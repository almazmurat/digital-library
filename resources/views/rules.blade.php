@extends('layouts.public')

@php
  $lang = request()->query('lang', 'ru');
  $lang = in_array($lang, ['kk', 'ru', 'en'], true) ? $lang : 'ru';
  $activePage = $activePage ?? 'rules';
  $pageLang = $lang;

  $copy = [
      'ru' => [
          'title' => 'Правила пользования библиотекой — KazUTB Digital Library',
          'toc_label' => 'Содержание',
          'policy_label' => 'Официальный документ',
          'headline' => 'Правила пользования библиотекой',
          'headline_secondary' => '(Library Usage Rules)',
          'lead' => 'Настоящие правила регулируют пользование помещениями, фондами и электронными ресурсами KazUTB Smart Library. Они обеспечивают равный доступ, академическую дисциплину и устойчивую исследовательскую среду.',
          'general_title' => 'Общие положения',
          'general_body' => 'KazUTB Smart Library обслуживает академическое сообщество и обеспечивает доступ к печатным и цифровым коллекциям по единым институциональным стандартам.',
          'general_points' => [
              'Действующее удостоверение университета является основным читательским документом.',
              'Читательские права не подлежат передаче третьим лицам.',
              'Сотрудники библиотеки вправе запросить удостоверение по требованию.',
          ],
          'borrowing_title' => 'Выдача и возврат',
          'borrowing_cards' => [
              [
                  'icon' => 'book',
                  'title' => 'Студенты бакалавриата',
                  'lines' => [
                      'Максимум: 5 единиц одновременно.',
                      'Срок выдачи: 14 дней.',
                      'Продление: 1 раз (если нет запроса от других читателей).',
                  ],
              ],
              [
                  'icon' => 'school',
                  'title' => 'Преподаватели и магистранты',
                  'lines' => [
                      'Максимум: 15 единиц одновременно.',
                      'Срок выдачи: 30 дней.',
                      'Продление: 2 раза (если нет запроса от других читателей).',
                  ],
              ],
          ],
          'digital_title' => 'Электронный доступ',
          'digital_body' => 'Доступ к лицензионным базам данных и электронным журналам предоставляется исключительно для академических и некоммерческих целей. Массовое скачивание полных выпусков или содержимого баз данных запрещено.',
          'digital_callout' => 'Удаленный доступ требует институциональные учетные данные Single Sign-On (SSO).',
      ],
      'kk' => [
          'title' => 'Кітапхананы пайдалану ережелері — KazUTB Digital Library',
          'toc_label' => 'Мазмұны',
          'policy_label' => 'Ресми құжат',
          'headline' => 'Кітапхананы пайдалану ережелері',
          'headline_secondary' => '(Library Usage Rules)',
          'lead' => 'Осы ережелер KazUTB Smart Library үй-жайларын, қорларын және цифрлық ресурстарын пайдалану тәртібін реттейді. Олар тең қолжетімділік, академиялық тәртіп және тұрақты зерттеу ортасын қамтамасыз етеді.',
          'general_title' => 'Жалпы ережелер',
          'general_body' => 'KazUTB Smart Library академиялық қауымдастыққа қызмет көрсетеді және баспа мен цифрлық қорларға бірыңғай институционалдық стандарттар арқылы қолжетімділік береді.',
          'general_points' => [
              'Университеттің жарамды куәлігі негізгі оқырман құжаты болып саналады.',
              'Оқырман құқықтарын үшінші тұлғаларға беруге болмайды.',
              'Кітапхана қызметкерлері қажет болған жағдайда куәлікті сұрата алады.',
          ],
          'borrowing_title' => 'Беру және қайтару',
          'borrowing_cards' => [
              [
                  'icon' => 'book',
                  'title' => 'Бакалавриат студенттері',
                  'lines' => [
                      'Максимум: бір уақытта 5 бірлік.',
                      'Берілетін мерзім: 14 күн.',
                      'Ұзарту: 1 рет (басқа оқырман сұратпаса).',
                  ],
              ],
              [
                  'icon' => 'school',
                  'title' => 'Оқытушылар және магистранттар',
                  'lines' => [
                      'Максимум: бір уақытта 15 бірлік.',
                      'Берілетін мерзім: 30 күн.',
                      'Ұзарту: 2 рет (басқа оқырман сұратпаса).',
                  ],
              ],
          ],
          'digital_title' => 'Электрондық қолжетімділік',
          'digital_body' => 'Лицензияланған дерекқорлар мен электрондық журналдарға қолжетімділік тек академиялық және коммерциялық емес мақсаттар үшін беріледі. Толық шығарылымдарды немесе дерекқор мазмұнын жаппай жүктеуге тыйым салынады.',
          'digital_callout' => 'Қашықтан қолжетімділік үшін институционалдық Single Sign-On (SSO) тіркелгі деректері қажет.',
      ],
      'en' => [
          'title' => 'Library Usage Rules — KazUTB Digital Library',
          'toc_label' => 'Contents',
          'policy_label' => 'Official Policy Document',
          'headline' => 'Library Usage Rules',
          'headline_secondary' => '(Правила пользования библиотекой)',
          'lead' => 'These rules govern the use of KazUTB Smart Library facilities, collections, and digital resources. They ensure equitable access, academic discipline, and a sustainable research environment.',
          'general_title' => 'General Provisions',
          'general_body' => 'KazUTB Smart Library serves the academic community and provides access to print and digital collections under unified institutional standards.',
          'general_points' => [
              'A valid university ID is the primary library credential.',
              'Library privileges are non-transferable to third parties.',
              'Library staff may request ID verification when needed.',
          ],
          'borrowing_title' => 'Borrowing & Returns',
          'borrowing_cards' => [
              [
                  'icon' => 'book',
                  'title' => 'Undergraduate Students',
                  'lines' => [
                      'Maximum: 5 items simultaneously.',
                      'Loan period: 14 days.',
                      'Renewals: 1 (if not requested by other readers).',
                  ],
              ],
              [
                  'icon' => 'school',
                  'title' => 'Faculty & Postgraduates',
                  'lines' => [
                      'Maximum: 15 items simultaneously.',
                      'Loan period: 30 days.',
                      'Renewals: 2 (if not requested by other readers).',
                  ],
              ],
          ],
          'digital_title' => 'Digital Access',
          'digital_body' => 'Access to licensed databases and e-journals is strictly for academic, non-commercial use. Systemic downloading of complete journal issues or database content is prohibited.',
          'digital_callout' => 'Remote access requires institutional Single Sign-On (SSO) credentials.',
      ],
  ][$lang];

    $toc = [
      'ru' => [
        ['href' => '#general', 'label' => '1. Общие положения'],
        ['href' => '#borrowing', 'label' => '2. Выдача и возврат'],
        ['href' => '#digital', 'label' => '3. Электронный доступ'],
        ['href' => '#conduct', 'label' => '4. Кодекс поведения'],
        ['href' => '#penalties', 'label' => '5. Нарушения и санкции'],
      ],
      'kk' => [
        ['href' => '#general', 'label' => '1. Жалпы ережелер'],
        ['href' => '#borrowing', 'label' => '2. Беру және қайтару'],
        ['href' => '#digital', 'label' => '3. Электрондық қолжетімділік'],
        ['href' => '#conduct', 'label' => '4. Мінез-құлық кодексі'],
        ['href' => '#penalties', 'label' => '5. Бұзушылықтар мен санкциялар'],
      ],
      'en' => [
        ['href' => '#general', 'label' => '1. General Provisions'],
        ['href' => '#borrowing', 'label' => '2. Borrowing & Returns'],
        ['href' => '#digital', 'label' => '3. Digital Access'],
        ['href' => '#conduct', 'label' => '4. Code of Conduct'],
        ['href' => '#penalties', 'label' => '5. Violations & Penalties'],
      ],
    ][$lang];
@endphp

@section('title', $copy['title'])

@section('content')
  <main class="rules-canonical" aria-label="Library usage rules content">
    <aside class="rules-canonical__toc" aria-label="{{ $copy['toc_label'] }}">
      <h3>{{ $copy['toc_label'] }}</h3>
      <ul>
        @foreach($toc as $item)
          <li><a href="{{ $item['href'] }}">{{ $item['label'] }}</a></li>
        @endforeach
      </ul>
    </aside>

    <article class="rules-canonical__article">
      <header class="rules-canonical__header">
        <p class="rules-canonical__policy">{{ $copy['policy_label'] }}</p>
        <h1>
          {{ $copy['headline'] }}
          <span>{{ $copy['headline_secondary'] }}</span>
        </h1>
        <p class="rules-canonical__lead">{{ $copy['lead'] }}</p>
      </header>

      <section class="rules-canonical__section" id="general">
        <h2>1. {{ $copy['general_title'] }}</h2>
        <div class="rules-canonical__panel rules-canonical__panel--elevated">
          <p>{{ $copy['general_body'] }}</p>
          <ul>
            @foreach($copy['general_points'] as $item)
              <li>{{ $item }}</li>
            @endforeach
          </ul>
        </div>
      </section>

      <section class="rules-canonical__section" id="borrowing">
        <h2>2. {{ $copy['borrowing_title'] }}</h2>
        <div class="rules-canonical__grid">
          @foreach($copy['borrowing_cards'] as $card)
            <div class="rules-canonical__panel">
              <span class="material-symbols-outlined rules-canonical__icon" aria-hidden="true">{{ $card['icon'] }}</span>
              <h3>{{ $card['title'] }}</h3>
              <p>
                @foreach($card['lines'] as $line)
                  {{ $line }}@if(! $loop->last)<br>@endif
                @endforeach
              </p>
            </div>
          @endforeach
        </div>
      </section>

      <section class="rules-canonical__section" id="digital">
        <h2>3. {{ $copy['digital_title'] }}</h2>
        <div class="rules-canonical__panel rules-canonical__panel--soft">
          <p>{{ $copy['digital_body'] }}</p>
          <div class="rules-canonical__callout">
            <span class="material-symbols-outlined" aria-hidden="true">vpn_key</span>
            <p>{{ $copy['digital_callout'] }}</p>
          </div>
        </div>
      </section>
    </article>
  </main>
@endsection

@section('head')
<style>
  .rules-canonical {
    max-width: 1280px;
    margin: 0 auto;
    padding: 128px 24px 120px;
    display: flex;
    flex-direction: column;
    gap: 64px;
  }

  .rules-canonical__toc {
    display: none;
  }

  .rules-canonical__article {
    max-width: 768px;
    width: 100%;
    flex: 1;
  }

  .rules-canonical__header {
    margin-bottom: 64px;
  }

  .rules-canonical__policy {
    margin: 0 0 16px;
    font-family: 'Manrope', sans-serif;
    font-size: 0.875rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #006a6a;
  }

  .rules-canonical__header h1 {
    margin: 0 0 24px;
    font-family: 'Newsreader', serif;
    font-size: clamp(2.35rem, 5vw, 3.75rem);
    line-height: 1.08;
    letter-spacing: -0.015em;
    color: #000613;
  }

  .rules-canonical__header h1 span {
    display: block;
    margin-top: 6px;
    font-size: clamp(1.45rem, 3.1vw, 1.875rem);
    font-weight: 500;
    line-height: 1.18;
    color: #43474e;
  }

  .rules-canonical__lead {
    margin: 0;
    font-family: 'Manrope', sans-serif;
    font-size: 1.125rem;
    line-height: 1.72;
    color: #43474e;
  }

  .rules-canonical__section {
    margin-bottom: 80px;
    scroll-margin-top: 128px;
  }

  .rules-canonical__section:last-child {
    margin-bottom: 0;
  }

  .rules-canonical__section h2 {
    margin: 0 0 32px;
    padding-bottom: 16px;
    border-bottom: 1px solid #d9dadb;
    font-family: 'Newsreader', serif;
    font-size: clamp(2rem, 3.2vw, 2.4rem);
    line-height: 1.12;
    color: #000613;
  }

  .rules-canonical__panel {
    padding: 32px;
    border-radius: 8px;
    background: #ffffff;
  }

  .rules-canonical__panel--elevated {
    box-shadow: 0 24px 48px -12px rgba(0, 6, 19, 0.04);
  }

  .rules-canonical__panel--soft {
    background: #f3f4f5;
  }

  .rules-canonical__panel p {
    margin: 0;
    font-family: 'Manrope', sans-serif;
    font-size: 0.9375rem;
    line-height: 1.78;
    color: #191c1d;
  }

  .rules-canonical__panel ul {
    margin: 22px 0 0;
    padding-left: 20px;
    font-family: 'Manrope', sans-serif;
    font-size: 0.9375rem;
    line-height: 1.78;
    color: #43474e;
    display: grid;
    gap: 10px;
  }

  .rules-canonical__grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
  }

  .rules-canonical__icon {
    display: inline-flex;
    margin-bottom: 12px;
    font-size: 1.9rem;
    color: #006a6a;
  }

  .rules-canonical__panel h3 {
    margin: 0 0 12px;
    font-family: 'Newsreader', serif;
    font-size: 1.42rem;
    line-height: 1.25;
    color: #000613;
  }

  .rules-canonical__callout {
    margin-top: 18px;
    padding: 14px 16px;
    border-radius: 6px;
    background: #e1e3e4;
    display: flex;
    gap: 12px;
    align-items: center;
  }

  .rules-canonical__callout .material-symbols-outlined {
    font-size: 1.2rem;
    color: #74777f;
    line-height: 1;
  }

  .rules-canonical__callout p {
    margin: 0;
    font-size: 0.875rem;
    line-height: 1.65;
    color: #43474e;
  }

  @media (min-width: 768px) {
    .rules-canonical {
      padding: 128px 48px 120px;
      flex-direction: row;
      gap: 64px;
      align-items: flex-start;
    }

    .rules-canonical__toc {
      display: block;
      width: 256px;
      flex-shrink: 0;
      position: sticky;
      top: 128px;
      height: fit-content;
    }

    .rules-canonical__toc h3 {
      margin: 0 0 24px;
      padding-left: 16px;
      border-left: 1px solid rgba(196, 198, 207, 0.7);
      font-family: 'Newsreader', serif;
      font-size: 1.5rem;
      font-weight: 500;
      color: #000613;
    }

    .rules-canonical__toc ul {
      margin: 0;
      padding: 0 0 0 16px;
      border-left: 1px solid rgba(196, 198, 207, 0.7);
      list-style: none;
      display: grid;
      gap: 16px;
    }

    .rules-canonical__toc a {
      text-decoration: none;
      font-family: 'Manrope', sans-serif;
      font-size: 1rem;
      line-height: 1.5;
      color: #43474e;
      transition: color 0.2s ease;
    }

    .rules-canonical__toc a:hover,
    .rules-canonical__toc a:focus-visible {
      color: #006a6a;
    }

    .rules-canonical__grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 32px;
    }
  }
</style>
@endsection
