<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('page_title')</title>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Rajesh kumar">
	<meta name="description" content="@yield('meta_description')">
	<meta name="keywords" content="@yield('meta_keywords')">

	<!-- Dark mode -->
	<script>
		const storedTheme = localStorage.getItem('theme')

		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
		}

		const setTheme = function(theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
			var el = document.querySelector('.theme-icon-active');
			if (el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
					const activeThemeIcon = document.querySelector('.theme-icon-active use')
					const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
					const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

					document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
						element.classList.remove('active')
					})

					btnToActive.classList.add('active')
					activeThemeIcon.setAttribute('href', svgOfActiveBtn)
				}

				window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
					if (storedTheme !== 'light' || storedTheme !== 'dark') {
						setTheme(getPreferredTheme())
					}
				})

				showActiveTheme(getPreferredTheme())

				document.querySelectorAll('[data-bs-theme-value]')
					.forEach(toggle => {
						toggle.addEventListener('click', () => {
							const theme = toggle.getAttribute('data-bs-theme-value')
							localStorage.setItem('theme', theme)
							setTheme(theme)
							showActiveTheme(theme)
						})
					})

			}
		})
	</script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=Poppins:wght@400;500;700&amp;display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/glightbox/css/glightbox.css') }}"> -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/choices/css/choices.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flatpickr/css/flatpickr.min.css') }}">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">

  <!-- GLightbox CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

  <style>
    /* small styling for thumbnails */
    .splide-main img { width: 100%; height: auto; display:block; object-fit:cover; }
    .splide-thumb .splide__slide img { width: 100%; height: 100%; object-fit: cover; display:block; border-radius:6px;}
    .splide-thumb .splide__slide { cursor:pointer; }
    .splide-thumb .splide__slide.is-active img { outline: 3px solid #6c5ce7; }
  </style>

</head>

<body>

	<!-- Header START -->
	<header class="navbar-light header-sticky">
		<!-- Logo Nav START -->
		<nav class="navbar navbar-expand-xl">
			<div class="container">
				<!-- Logo START -->
				<a class="navbar-brand" href="{{ route('home') }}">
					<img class="light-mode-item navbar-brand-item" src="{{ asset($websiteSettings->logo) }}" alt="logo">
					<img class="dark-mode-item navbar-brand-item" src="{{ asset($websiteSettings->logo) }}" alt="logo">
				</a>
				<!-- Logo END -->


				<!-- Responsive category toggler -->
				<button class="navbar-toggler ms-sm-auto mx-3 me-md-0 p-0 p-sm-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategoryCollapse" aria-controls="navbarCategoryCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-animation">
						<span></span>
						<span></span>
						<span></span>
					</span>
					<span class="d-none d-sm-inline-block small">Menu</span>
				</button>

				<!-- Nav category menu START -->
				<div class="navbar-collapse collapse" id="navbarCategoryCollapse">
					<ul class="navbar-nav navbar-nav-scroll nav-pills-primary-soft text-start ms-auto p-2 p-xl-0">
                  <!-- Single Menu -->
                     @foreach ($header_menu as $menu)
                         <li class="nav-item">
                              <a class="nav-link {{ url()->current() == url($menu->url) ? 'active' : '' }}"
                                 href="{{ $menu->url }}">
                                 {{ $menu->title }}
                              </a>
                        </li>
                     @endforeach
					</ul>

				</div>
				<!-- Nav category menu END -->

			</div>
		</nav>
		<!-- Logo Nav END -->
	</header>
	<!-- Header END -->

	<!-- **************** MAIN CONTENT START **************** -->
	<main>
		@yield('content')
	</main>
	<!-- **************** MAIN CONTENT END **************** -->

	<!-- =======================
Footer START -->
<footer class="bg-dark pt-5">
   <div class="container">
      <div class="g-4 row">
         <div class="col-lg-4">
            <a href="{{ route('home') }}"><img class="h-40px" src="{{ asset($websiteSettings->logo) }}" alt="logo"></a>
            <p class="my-3 text-body-secondary">{{ $websiteSettings->about_website }}</p>
            <p class="mb-2">
               <a class="text-body-secondary text-primary-hover d-flex align-items-center" href="tel:{{ $websiteSettings->contact_phone }}">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class=" me-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"></path>
                  </svg>
                  {{ $websiteSettings->contact_phone }}
               </a>
            </p>
            <p class="mb-0">
               <a class="text-body-secondary text-primary-hover d-flex align-items-center" href="mailto:{{ $websiteSettings->contact_email }}">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" class=" me-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"></path>
                  </svg>
                  {{ $websiteSettings->contact_email }}
               </a>
            </p>
            <ul class="list-inline mb-0 mt-3 d-flex gap-2 justify-content-start">
               <li class="list-inline-item">
                  <a role="button" tabindex="0" target="_blank" href="{{ $websiteSettings->facebook }}" class="shadow px-2 bg-facebook mb-0 btn btn-primary btn-sm">
                     <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                     </svg>
                  </a>
               </li>
               <li class="list-inline-item">
                  <a role="button" tabindex="0" target="_blank" href="{{ $websiteSettings->instagram }}" class="shadow px-2 bg-instagram mb-0 btn btn-primary btn-sm">
                     <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                     </svg>
                  </a>
               </li>
               <li class="list-inline-item">
                  <a role="button" tabindex="0" target="_blank" href="{{ $websiteSettings->twitter }}" class="shadow px-2 bg-twitter mb-0 btn btn-primary btn-sm">
                     <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                     </svg>
                  </a>
               </li>
               <li class="list-inline-item">
                  <a role="button" tabindex="0" target="_blank" href="{{ $websiteSettings->youtube }}" class="shadow px-2 mb-0 btn btn-danger btn-sm">
                     <i class="bi bi-youtube"></i>
                  </a>
               </li>
            </ul>
         </div>
         <div class="ms-auto col-lg-8">
            <div class="g-4 row">
               <div class="col-md-3 col-6">
                  <h5 class="text-white mb-2 mb-md-4">Page</h5>
                  <div class="flex-column text-primary-hover nav">
                      @if ($footer_menu_1)
                           @foreach ($footer_menu_1 as $menu1)
                           <div class="nav-item">
                              <a href="{{ $menu1->url }}" class="text-body-secondary d-flex align-items-center nav-link">{{ $menu1->title }}</a>
                           </div>
                          
                           @endforeach
                           @else
                           <p>No menu found!</p>
                           @endif
                        </div>
               </div>
               <div class="col-md-3 col-6">
                  <h5 class="text-white mb-2 mb-md-4">Tours</h5>
                  <div class="flex-column text-primary-hover nav">
                     <div class="nav-item">
                          @if ($footer_menu_2)
                           @foreach ($footer_menu_2 as $menu2)
                            <a href="{{ $menu2->url }}" class="text-body-secondary d-flex align-items-center nav-link">{{ $menu2->title }}</a>
                           @endforeach
                           @else
                           <p>No menu found!</p>
                           @endif
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-6">
                  <h5 class="text-white mb-2 mb-md-4">Latest Blogs</h5>
                  <div class="flex-column text-primary-hover nav">
                     <div class="nav-item">
                         @if ($footer_menu_3)
                           @foreach ($footer_menu_3 as $menu3)
                           <a href="{{ $menu3->url }}" class="text-body-secondary d-flex align-items-center nav-link">{{ $menu3->title }}</a>
                           @endforeach
                           @else
                           <p>No menu found!</p>
                           @endif
                     </div>
                 </div>
               </div>
               <div class="col-md-3 col-6">
                  <h5 class="text-white mb-2 mb-md-4">Support</h5>
                  <div class="flex-column text-primary-hover nav">
                     @if ($footer_menu_4)
                     @foreach ($footer_menu_4 as $menu4)
                     <div class="nav-item">
                        <a href="{{$menu4->url}}" class="text-body-secondary d-flex align-items-center nav-link">
                            {{$menu4->title}}
                        </a>
                     </div>
                     @endforeach
                     @else
                     <p>No menu found!</p>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <hr class="mt-4 mb-0">
      <div class="row">
         <div class="container">
            <div class="d-lg-flex justify-content-between align-items-center py-3 text-center text-lg-start">
               <div class="text-body-secondary text-primary-hover"> Copyrights ©{{ date('Y') }} {{ $websiteSettings->site_name }}. Build by <a href="https://rajeshkumar.fun/" target="_blank" class="text-body-secondary">Rajesh</a>. </div>
               <div class="nav mt-2 mt-lg-0 nav">
                  <ul class="list-inline text-primary-hover mx-auto mb-0">
                     <li class="list-inline-item me-0"><a href="/privacy-policy" role="button" class="text-body-secondary py-1 nav-link" tabindex="0">Privacy policy</a></li>
                     <li class="list-inline-item me-0"><a href="/terms-of-service" role="button" class="text-body-secondary py-1 nav-link" tabindex="0">Terms and conditions</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
	<!-- =======================
Footer END -->

	<!-- Back to top -->
	<div class="back-top"></div>

	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

	<!-- Vendors -->
	<script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
	<!-- <script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script> -->
	<script src="{{ asset('assetsvendor/choices/js/choices.min.js') }}/"></script>
	<script src="{{ asset('assets/vendor/flatpickr/js/flatpickr.min.html') }}"></script>

	<!-- ThemeFunctions -->
	<script src="{{ asset('assets/js/functions.js') }}"></script>

  <!-- GLightbox JS -->
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
  <script>
  const lightbox = GLightbox({
    selector: '.glightbox'
  });
</script>
<script>
    // Hide all .alert elements after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";

            // Remove from DOM after fade-out
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
</body>

</html>