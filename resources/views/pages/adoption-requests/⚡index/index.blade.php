{{--@php

        $filter_options =[
           [
            'name' => 'ABC',
        'value' =>'ABC',
        ],
                   [
            'name' => 'ZYX',
        'value' =>'ZYX',
        ],
                   [
            'name' => 'latest',
        'value' =>'plus récents',
        ],
];

@endphp--}}

<main class="main-container adoption-request" id="content">
    @can('viewAny', \App\Models\Request::class)
    <x-page-bar>
        {{__('admin/adoption-requests.adoption_requests')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::adoption-requests.create', ['locale' => app()->getLocale()])}}" title="{{__('admin/adoption-requests.go_to_create_request')}}" class="">
                {{__('admin/adoption-requests.create_a_request')}}
            </x-admin.admin-button>
            <x-admin.search/>
        </div>
{{--        <div class="bottom-row bottom-row-volunteer">
            <div>
                <x-select select_name="filtering" label="Trier" :options="$filter_options" wire="filtering"/>
            </div>
        </div>--}}
    </div>
    <table class="table max-w-admin-web m-b-32">
        <thead>
        <tr>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('last_name')" :direction="$sortField === 'last_name'? $sortDirection : null" class="{{$sortField === 'last_name'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.name')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at'? $sortDirection : null" class="{{$sortField === 'created_at'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.date')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('animal_name')" :direction="$sortField === 'animal_name'? $sortDirection : null" class="{{$sortField === 'animal_name'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.animal')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('state')" :direction="$sortField === 'state'? $sortDirection : null" class="{{$sortField === 'state'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.state')}}
            </x-admin.table.table-th-sort>
        </tr>
        </thead>
        <tbody>
        @forelse($this->searchedRequests as $request)
            <tr class="table-row table-row-flex modal-tr" >
                <x-admin.table.table-td class="{{ $request->state === 'not_treated_yet' ? 'fw-700' : '' }}">
                    <span class="show-web">{{__('admin/adoption-requests.name_title')}}</span>{!! $request->last_name !!} {!! $request->first_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class=" fw-medium">
                    <span class="show-web">{{__('admin/adoption-requests.date_title')}}</span>{!! $request->created_at->format('d.m.Y') !!}
                </x-admin.table.table-td>
                {{--@php($animal = \App\Models\Animal::where('id', $request->animal_id)->first())--}}
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.animal_title')}}</span>{!! $request->animal_name !!}
                </x-admin.table.table-td>

                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.state_title')}}</span>
                    {!! $request->state == 'adopted'? __('admin/adoption-requests.adopted') : ($request->state == 'in_treatment' ? __('admin/adoption-requests.in_treatment') : ($request->state == 'refused' ? __('admin/adoption-requests.refused') :__('admin/adoption-requests.not_treated_yet') ) )!!}
                    {{--<a href="{{route('pages::adoption-requests.show',  ['locale' => app()->getLocale(),  'adoption_requests' => $request->id])}}" title="{{__('admin/adoption-requests.got_to_request_page')}}" class="card-link">
                    </a>--}}
                    <button wire:click="openModal({{ $request->id }})" class="modal-tr-link">

                    </button>
                   {{--TO DO MODAL--}}
                    {{--<a href="{{route('pages::adoption-requests.show',  ['locale' => __('general.currentLocale'),  'request' => $request->id])}}" title="aller vers la page de l’animal" class="card-link">
                    </a>--}}
                </x-admin.table.table-td>
            </tr>
            @empty
                <tr class="table-row position-relative" >
                    <x-admin.table.table-td class="table-img">
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-name fw-medium">
                        {{__('admin/adoption-requests.no_request_found')}}
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
        {{ $this->searchedRequests->links() }}
    </div>


    <section wire:show="showModal" class="message-modal border-r-small z-index-10 max-w-web">
        <div class="d-flex title-close">
            <h3 class="">
                {{__('admin/adoption-requests.adoption_request')}}
            </h3>

            <button wire:click="closeModal" class="close-modal d-inline">
                {{__('admin/messages.close')}}  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="d-inline">
                    <path
                        d="M6.40331 18.3113L5.69531 17.6033L11.2953 12.0033L5.69531 6.40331L6.40331 5.69531L12.0033 11.2953L17.6033 5.69531L18.3113 6.40331L12.7113 12.0033L18.3113 17.6033L17.6033 18.3113L12.0033 12.7113L6.40331 18.3113Z"
                        fill="black"/>
                </svg>
            </button>
        </div>

        @if($openRequest && $showModal )
        <div class="modal-information">
            <dl class="grid-name">
                <x-definition-term>
                    {{__('admin/adoption-requests.adoption_request_for')}}
                </x-definition-term>
                <x-definition>
                    @php($animal = \App\Models\Animal::where('id', $openRequest->animal_id)->first())
                    {!! $animal->animal_name !!}
                </x-definition>
                <x-definition-term>
                    {{__('admin/adoption-requests.name')}}
                </x-definition-term>
                <x-definition>
                    {!! $openRequest->last_name !!} {!! $openRequest->first_name !!}
                </x-definition>
            </dl>

            <dl class="grid-subject">
                <x-definition-term>
                    {{__('admin/messages.date')}}
                </x-definition-term>
                <x-definition>
                    {!! $openRequest->created_at->format('d.m.Y') !!}
                </x-definition>
                <x-definition-term>
                    {{__('admin/adoption-requests.adress')}}
                </x-definition-term>
                <x-definition>
                    {!! $openRequest->address !!}
                </x-definition>
            </dl>

            <dl class="grid-email">
                <x-definition-term>
                    {{__('admin/messages.email')}}
                </x-definition-term>
                <x-definition>
                    <a href="mailto:{!! $openRequest->email !!}" title="{{__('admin/contacts.send_mail_to')}}">
                        {!! $openRequest->email !!}
                    </a>
                </x-definition>
                <x-definition-term>
                    {{__('admin/adoption-requests.phone')}}
                </x-definition-term>
                <x-definition>
                    <a href="tel:{!! $openRequest->phone !!}" title="{{__('admin/adoption-requests.call')}}">
                        {!! $openRequest->phone !!}
                    </a>
                </x-definition>
                <x-definition-term>
                    {{__('admin/messages.state')}}
                </x-definition-term>

                    @can('update', $openRequest)
                    <x-definition>
                    <select name="state" id="state" wire:change="updateState($event.target.value)" wire:key="state-select-{{ $openRequest->id }}-{{ $lastChanged }}">
                        <option value="adopted" @selected($openRequest->state === 'adopted')>{{__('admin/adoption-requests.adopted')}}</option>
                        <option value="refused" @selected($openRequest->state === 'refused')>{{__('admin/adoption-requests.refused')}}</option>
                        <option value="in_treatment" @selected($openRequest->state === 'in_treatment')>{{__('admin/adoption-requests.in_treatment')}}</option>
                        <option value="not_treated_yet" @selected($openRequest->state === 'not_treated_yet')>{{__('admin/adoption-requests.not_treated_yet')}}</option>
{{--


                        <x-select-option option_value="adopted" option_name="{{__('admin/adoption-requests.adopted')}}">
                        </x-select-option>
                        <option value="refused" selected="{{$openRequest->state}} === 'adopted'">{{__('admin/adoption-requests.refused')}}</option>
                        <x-select-option option_value="refused" option_name="{{__('admin/adoption-requests.refused')}}">
                            {{__('admin/adoption-requests.refused')}}
                        </x-select-option>
                        <x-select-option option_value="in_treatment" option_name="{{__('admin/adoption-requests.in_treatment')}}">
                        </x-select-option>
                        <x-select-option option_value="not_treated_yet" option_name="{{__('admin/adoption-requests.not_treated_yet')}}">
                        </x-select-option>--}}
                    </select>
                    </x-definition>
                    @endcan
                        @can('viewLimited', $openRequest)
                            <x-definition>
                                {!! $openRequest->state == 'adopted' ? __('admin/adoption-requests.adopted'):($openRequest->state == 'refused'  ? __('admin/adoption-requests.refused'): ($openRequest->state == 'in_treatment' ? __('admin/adoption-requests.in_treatment') :  __('admin/adoption-requests.not_treated_yet')) ) !!}
                            </x-definition>
                        @endcan

            </dl>


            <dl class="grid-date">
                <x-definition-term class="grid-message">
                    {{__('admin/messages.message')}}
                </x-definition-term>
                <x-definition>
                    {!! $openRequest->message !!}
                </x-definition>
            </dl>

            <dl class="grid-state request-comment">
                <x-definition-term>
                    {{__('admin/adoption-requests.comment')}}
                </x-definition-term>
                <x-definition>
                    {!! $openRequest->comment !!}
                </x-definition>
            </dl>

        </div>
        <div class="modal-buttons">
            @can('update', $openRequest)
            <button wire:click="requestDeny" class="modal-button fw-medium background-refuse ">
                {{__('admin/adoption-requests.deny_request')}}
            </button>
            <button wire:click="requestAccept" class="modal-button fw-medium background-validation">
                {{__('admin/adoption-requests.accept_request')}}
            </button>
            <form wire:submit="destroy" method="post">
                @csrf
                <x-admin.modals.message.submit-button title="{{__('admin/adoption-requests.delete_request')}}" class="modal-button">
                    {{__('admin/adoption-requests.delete_adoption_request')}}
                </x-admin.modals.message.submit-button>

            </form>
            @endcan
            <a href="{{route('pages::adoption-requests.edit',  ['locale' => app()->getLocale(),  'adoption_request' => $openRequest->id])}}" class="modal-button fw-medium background-light" title="{{__('admin/adoption-requests.go_to_modify_request_page')}}">
                {{__('admin/adoption-requests.modify_request')}}
            </a>
        </div>
            @if($showEmailModal)
                <div class="bg-opacity">
                <div class="confirmation-modal border-r-big d-flex flex-c j-c-center flex-gap-56">
                    <p>Voulez-vous envoyer un email à {{$openRequest->first_name}} {{$openRequest->last_name}} pour lui prévenir qu'on est en train de traiter sa demande d’adoption?</p>
                    <div class="d-flex flex-r flex-j-c-space-between j-c-center flex-gap-32 flex-wrap">
                        <x-admin.modals.adoption-request.btn wire="confirmSendingEmail" class="confirm modal-button fw-medium color-white regular-shadow">
                            {{__('admin/adoption-requests.confirm_sending_mail')}}
                        </x-admin.modals.adoption-request.btn>
                        <x-admin.modals.adoption-request.btn wire="denySendingEmail" class="deny modal-button fw-medium color-white regular-shadow">
                            {{__('admin/adoption-requests.deny_sending_mail')}}
                        </x-admin.modals.adoption-request.btn>
                    </div>
                </div>
                </div>
            @endif
        @endif

    </section>
    @endcan
</main>
