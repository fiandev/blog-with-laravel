<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Primary Meta Tags -->
<meta name="description" content="{{ env('DESCRIPTION_PAGE', '') }}" />
<meta name="keywords" content="{{ getKeywords() }}" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/') }}">
<meta property="og:title" content="MyBlog">
<meta property="og:description" content="{{ env('DESCRIPTION_PAGE', '') }}">
<meta property="og:image" content="{{ icon_web() }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url('/') }}">
<meta property="twitter:title" content="MyBlog">
<meta property="twitter:description" content="{{ env('DESCRIPTION_PAGE', '') }}">
<meta property="twitter:image" content="{{ icon_web() }}">