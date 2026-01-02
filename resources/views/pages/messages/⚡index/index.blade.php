@php

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
]

@endphp
@props([
    'message'
])

<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/messages.messages')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="mailto: "
                                  title="Ecrire un email" class="">
                {{__('admin/messages.send_email')}}
            </x-admin.admin-button>
            <x-admin.search/>
        </div>
        <div class="bottom-row bottom-row-volunteer">
            <div>
                <x-select select_name="filtering" label="Trier" :options="$filter_options" wire="filtering"/>
            </div>
        </div>
    </div>
    <table class="table max-w-admin-web">
        <thead>
        <tr>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.name')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.subject')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.date')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.see_message')}}
            </x-admin.table.table-th>

        </tr>
        </thead>
        <tbody>

        @foreach($this->searchedMessages() as $message)
            <tr class="table-row table-row-flex position-relative" >
                <x-admin.table.table-td class="{{ $message->state === 'not_read_yet' ? 'fw-700' : '' }}">
                    <span class="show-web">{{__('admin/messages.name_title')}}</span>{!! $message->last_name !!} {!! $message->first_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.subject_title')}}</span>{!! $message->subject !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.date_title')}}</span>{!! $message->created_at->format('d.m.Y') !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class=" fw-medium">
                    <button wire:click="openModal({{ $message->id }})">
                        {{__('admin/messages.open_message')}}
                    </button>
                </x-admin.table.table-td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if($isopenModal && $openMessage)

        <section class="message-modal border-r-small z-index-10 max-w-web">
            <div class="d-flex title-close">
                <h3 class="">
                    {{__('admin/messages.contact_message')}}
                </h3>

                    <button wire:click="closeModal" class="close-modal d-inline">
                        {{__('admin/messages.close')}}  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="d-inline">
                            <path
                                d="M6.40331 18.3113L5.69531 17.6033L11.2953 12.0033L5.69531 6.40331L6.40331 5.69531L12.0033 11.2953L17.6033 5.69531L18.3113 6.40331L12.7113 12.0033L18.3113 17.6033L17.6033 18.3113L12.0033 12.7113L6.40331 18.3113Z"
                                fill="black"/>
                        </svg>
                    </button>
            </div>
            <dl class="modal-information">
                <div class="grid-name">
                    <x-definition-term>
                        {{__('admin/messages.name')}}
                    </x-definition-term>
                    <x-definition>
                        {!! $openMessage->last_name !!} {!! $openMessage->first_name !!}
                    </x-definition>
                </div>

                <div class="grid-subject">
                    <x-definition-term>
                        {{__('admin/messages.subject')}}
                    </x-definition-term>
                    <x-definition>
                        {!! $openMessage->subject !!}
                    </x-definition>
                </div>

                <div class="grid-email">
                    <x-definition-term>
                        {{__('admin/messages.email')}}
                    </x-definition-term>
                    <x-definition>
                        {!! $openMessage->email !!}
                    </x-definition>
                </div>
                <div class="grid-date">
                    <x-definition-term>
                        {{__('admin/messages.date')}}
                    </x-definition-term>
                    <x-definition>
                        {!! $openMessage->created_at->format('d.m.Y') !!}
                    </x-definition>
                </div>

                <div class="grid-state">
                    <x-definition-term>
                        {{__('admin/messages.state')}}
                    </x-definition-term>
                    <x-definition>
                        {!! $openMessage->state !!}
                    </x-definition>
                </div>
                <div>
                    <x-definition-term class="grid-message">
                        {{__('admin/messages.message')}}
                    </x-definition-term>
                    <x-definition>
                        {!! $openMessage->message !!}
                    </x-definition>
                </div>
            </dl>
            <div class="modal-buttons">
                <button wire:click="messageIsRead" class="modal-button fw-medium background-validation">
                    {{__('admin/messages.message_seen')}}
                </button>
                <a class="modal-button fw-medium answer-button" href="mailto:{!! $openMessage->email !!}">
                    {{__('admin/messages.answer')}}
                </a>
                <form wire:submit="destroy" method="post">
                    @csrf
                    <x-admin.modals.message.submit-button title="Supprimer le message" class="modal-button">
                        {{__('admin/messages.delete_message')}}
                    </x-admin.modals.message.submit-button>

                </form>
            </div>
        </section>
    @endif

</main>
