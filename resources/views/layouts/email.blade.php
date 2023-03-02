<div style="background: #000; font-family: Verdana,serif; font-size: 16px; padding: 20px;">
    <div style="max-width: 600px; width: 100%; border-radius: 10px; margin: 0 auto; display: block; background: #fff; color: #000; padding: 20px;">
        <div style="text-align: center;">
            <h1>{{ env('ADMIN_COMPANY') }}</h1>
        </div>
        <div style="min-height: 250px;">
            @yield('content')
        </div>
        <div style="text-align: center; font-size: 12px; font-style: italic;">
            &copy; Copyright {{ date('Y') }} {{ env('ADMIN_COMPANY') }}
        </div>
    </div>
</div>
