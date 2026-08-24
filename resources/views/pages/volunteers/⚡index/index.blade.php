@can('viewAny', \App\Models\User::class)
<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/volunteers.volunteers')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            @can('create', \App\Models\User::class)
            <x-admin.admin-button href="{{route('pages::volunteers.create', ['locale' => app()->getLocale()])}}"
                                  title="{{__('admin/volunteers.go_to_create_volunteer')}}" class="">
                {{__('admin/volunteers.create_a_volunteer')}}
            </x-admin.admin-button>
            @endcan
            <x-admin.search/>
        </div>
    </div>
    <table class="table max-w-admin-web m-b-32">
        <thead>
        <tr>
            <x-admin.table.table-th scope="col">
                {{__('admin/volunteers.image')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('last_name')" :direction="$sortField === 'last_name'? $sortDirection : null" class="{{$sortField === 'last_name'? 'active-sort': ''}}">
                {{__('admin/volunteers.name')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('phone')" :direction="$sortField === 'phone'? $sortDirection : null" class="{{$sortField === 'phone'? 'active-sort': ''}}">
                {{__('admin/volunteers.phone_number')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('is_admin')" :direction="$sortField === 'is_admin'? $sortDirection : null" class="{{$sortField === 'is_admin'? 'active-sort': ''}}">
                {{__('admin/volunteers.role')}}
            </x-admin.table.table-th-sort>
        </tr>
        </thead>
        <tbody>

        @forelse($this->searchedUsers as $volunteer)
            <tr class="table-row position-relative">
                <x-admin.table.table-td class="table-img">
                    @if($volunteer->profile_image)
                        <img src="{{Storage::disk('s3')->url('images/users/variants/100x100/'.basename($volunteer->profile_image))}}" alt="{{__('admin/volunteers.volunteer_img')}}"
                             class="border-r-big animal-img">
                    @else
                        <img src="{!! asset('assets/content/default.jpg') !!}" alt="{{__('admin/animals.animal_image')}}" width="100" height="100"
                             class="border-r-big animal-img">
                    @endif
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-name fw-medium">
                    <span class="show-web">{{__('admin/volunteers.name_title')}}</span>{!! $volunteer->last_name !!} {!! $volunteer->first_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-state">
                    <span class="show-web">{{__('admin/volunteers.phone_number_title')}}</span>{!! $volunteer->phone !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-species">
                    <span class="show-web">{{__('admin/volunteers.role_title')}}</span>{!! $volunteer->is_admin?   __('admin/volunteers.admin'): __('admin/volunteers.volunteer') !!}
                    <a href="{{route('pages::volunteers.show',  ['locale' => __('general.currentLocale'),  'volunteer' => $volunteer->id])}}" title="{{__('admin/volunteers.go_to_person_page')}}" class="card-link">
                    </a>
                </x-admin.table.table-td>
            </tr>
            @empty
                <tr class="table-row position-relative">
                    <x-admin.table.table-td class="table-img">
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-name fw-medium">
                        {{__('admin/volunteers.no_volunteer_found')}}
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-state">
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-species">
                    </x-admin.table.table-td>

                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-admin max-w-admin-web m-b-80">
        {{ $this->searchedUsers->links() }}
    </div>
</main>
@endcan


