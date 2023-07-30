@extends('layouts.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a></li>
            <li class="breadcrumb-item"><a href="{{ route('devices') }}">Destek Talepleri</a></li>
            <li class="breadcrumb-item active" aria-current="page">Destek Talebi #GF31DS</li>
        </ol>
    </nav>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <h6>Cihazın ışığı yanıp sönüyor | Destek Talebi #GF31DS - <a href="#">Hizmet: SC-23</a></h6>
            </div>
        </div>
    </div>

    <div class="row chat-wrapper">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row position-relative">
                        <div class="col-12 chat-content">
                            <div class="chat-header border-bottom pb-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="corner-up-left" id="backToChatList" class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                                        <figure class="mb-0 me-2">
                                            <img src="{{ url('https://via.placeholder.com/43x43') }}" class="img-sm rounded-circle" alt="image">
                                            <div class="status online"></div>
                                            <div class="status online"></div>
                                        </figure>
                                        <div>
                                            <p>Ali Onur Serçe</p>
                                            <p class="text-muted tx-13">superLOG Destek</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-body">
                                <ul class="messages">
                                    <li class="message-item friend">
                                        <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                                        <div class="content">
                                            <div class="message">
                                                <div class="bubble">
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos praesentium, voluptates ducimus doloribus aliquam, debitis facere enim iure cumque repellat, autem vero. Delectus dignissimos soluta necessitatibus quos quaerat ab dolor!</p>
                                                </div>
                                                <span>8:17 PM</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="message-item me">
                                        <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                                        <div class="content">
                                            <div class="message">
                                                <div class="bubble">
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt ea ad sint aut modi repellat cum commodi, nam debitis facere, ullam alias itaque exercitationem pariatur explicabo consequuntur fugit ipsum nobis! Molestias, tenetur quos dolorum recusandae rem ex sint, tempora quis quo, quidem voluptates fugit. Vel similique accusantium laborum ratione porro!</p>
                                                </div>
                                            </div>
                                            <div class="message">
                                                <div class="bubble">
                                                    <p>Lorem Ipsum.</p>
                                                </div>
                                                <span>8:18 PM</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="message-item friend">
                                        <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                                        <div class="content">
                                            <div class="message">
                                                <div class="bubble">
                                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta, molestiae reprehenderit iste officia, officiis saepe aliquid voluptatum aspernatur animi perspiciatis nisi minus laudantium earum tenetur. Omnis commodi incidunt error obcaecati atque eos maxime blanditiis consequatur in sunt quis soluta dolores reiciendis impedit officiis necessitatibus odit, deserunt consequuntur! Ullam nihil neque eligendi minima consectetur, suscipit perspiciatis reiciendis rerum autem non quaerat ducimus laboriosam? Ut quo cumque veritatis fugit id, officiis asperiores assumenda voluptatum nemo recusandae iure ad incidunt rem molestiae, dolorum pariatur esse. Veritatis illo vitae unde facere, sunt eligendi ipsa! Rem nemo debitis ea qui dolores repellat, tempore cupiditate voluptate voluptatum laborum impedit quo, exercitationem ipsum dolor velit quam deleniti maxime excepturi, totam eum consequatur nulla! Eos soluta unde itaque?.</p>
                                                </div>
                                                <span>8:22 PM</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="message-item me">
                                        <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                                        <div class="content">
                                            <div class="message">
                                                <div class="bubble">
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quisquam error architecto nisi in illum aspernatur laudantium nam ad enim debitis pariatur eveniet facilis, voluptatum nostrum quaerat perspiciatis assumenda quia corporis numquam accusantium. Vel, inventore? Nostrum id odio inventore facere nulla doloremque eaque quia nemo hic, quaerat impedit ullam eius.</p>
                                                </div>
                                                <span>8:30 PM</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat-footer d-flex">
                                <form class="search-form flex-grow-1 me-2">
                                    <div class="input-group">
                                        <textarea class="form-control" name="" id="" cols="30" rows="3"></textarea>
                                        {{-- <input type="text" class="form-control rounded-pill" id="chatForm" placeholder="Mesajınız"> --}}
                                    </div>
                                </form>
                                <div class="">
                                    <div class="d-none d-md-block">
                                        <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" data-bs-title="Dosya yükleyin">
                                            <i data-feather="paperclip" class="text-muted"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-icon rounded-circle">
                                            <i data-feather="send"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/chat.js') }}"></script>
    <script>
        $(function() {
            'use strict';
            $('#myDropify').dropify({
                messages: {
                    'default': 'Dosya yüklemek için buraya sürükleyin',
                    'replace': 'Dosyayı değiştirmek için bu alana yeni bir dosya sürükleyin',
                    'remove': 'Kaldır',
                    'error': 'Bir hata oluştu.'
                }
            });
        });
    </script>
@endpush
