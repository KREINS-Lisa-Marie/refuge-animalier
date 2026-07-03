@if( app()->currentLocale() == 'fr')
    <a href="{{route("pages::profile.index", ['locale' => 'en'])}}" class="change_language_link">
        {{__('admin/profile.change_language')}}
    </a>
@else
    <a href="{{route("pages::profile.index", ['locale' => 'fr'])}}" class="change_language_link">
        {{__('admin/profile.change_language')}}
    </a>
@endif
