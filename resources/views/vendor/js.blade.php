{{--BEGIN VENDOR JS--}}
<script>
    window.Laravel = {!! json_encode([
	'csrfToken' => csrf_token(),
	'baseUrl' => url('/'),
	'routes' => collect(\Route::getRoutes())->mapWithKeys(function ($route) { return [$route->getName() => $route->uri()]; })
]) !!};
</script>
<script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>
<script src="{{asset('vue/app.js')}}"></script>
<script src="{{ asset('js/site.js') }}" type="text/javascript"></script>
{{--END VENDOR JS--}}