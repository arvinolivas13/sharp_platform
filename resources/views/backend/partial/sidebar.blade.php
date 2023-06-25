@inject('apptype', 'App\AppType')

@php
    $apps = $apptype->with('apps', 'apps.app_modules')->orderBy('sort_no', 'asc')->get();
@endphp
{{-- {{$apps}} --}}
<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">

        <a class="sidebar-toggle mr-2">
            <i class="fas fa-bars"></i>
        </a>

        <div class="company-logo">
            <img src="/images/logo.png" class="logo1" alt="company-logo" width="100%"/>
            <img src="/images/logo-2.png" class="logo2" alt="company-logo-2" width="100%"/>
            <div class="company-name">
                Company Name
            </div>
        </div>

        <ul class="sidebar-nav" style="overflow-x: hidden;">
            @foreach ($apps as $app)
                <li class="sidebar-header">{{$app->name}}</li>
                <li class="sidebar-item">
                    @foreach ($app->apps as $item)
                        @if($item->module === 1)
                            <a href="#{{$item->code}}" data-toggle="collapse" class="sidebar-link collapsed">
                                <span class="item">
                                    <i class="align-middle mr-2 fas fa-fw fa-{{$item->icon}}"></i> <span class="align-middle">{{$item->name}}</span>
                                </span>
                            </a>
                            <ul id="{{$item->code}}" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                                <li class="list-title">{{$item->name}}</li>
                                @foreach ($item->app_modules as $module)
                                    <li class="sidebar-item"><a class="sidebar-link" href="/project/{{$app->code}}/{{$item->code}}/{{$module->code}}">{{$module->name}}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <a href="" data-toggle="collapse" class="sidebar-link collapsed">
                                <span class="item">
                                    <i class="align-middle mr-2 fas fa-fw fa-{{$item->icon}}"></i> <span class="align-middle">{{$item->name}}</span>
                                </span>
                            </a>
                        @endif
                    @endforeach
                </li>
            @endforeach
        </ul>
    </div>
</nav>

{{-- <script>
function clickSide() {
    $.get('/project/maintenance/app/sample').done(function(response) {
        console.log(response);
    });
}
</script> --}}