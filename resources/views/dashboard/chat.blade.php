@extends('dashboard.layout')

@section('content')
    <div class="chat-block">

        <!-- begin::chat sidebar -->
        <div class="chat-sidebar">

            <!-- begin::chat sidebar search -->
            <div class="chat-sidebar-header">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab"
                            aria-controls="pills-home" aria-selected="true">All Chats</a>
                    </li>
                </ul>
                <form class="my-4">
                    <input type="text" class="form-control" placeholder="Search">
                </form>
            </div>
            <!-- begin::chat sidebar search -->

            <!-- end::chat list -->
            <div class="chat-sidebar-content">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="chat-lists">
                            <div class="p-3 list-group list-group-flush list-group-flush-chat">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end::chat list -->

        </div>
        <!-- end::chat sidebar -->

        <!-- begin::chat content -->
        <div class="chat-content empty-chat-wrapper">

            <div class="empty-chat">
                <div class="mb-5 row">
                    <div class="m-auto col-md-4">
                        <img class="img-fluid" src="../images/svg/not-selected-chat.svg" alt="image">
                    </div>
                </div>
                <p>Select chat to view messages</p>
            </div>

            <!-- begin::messages -->
            <div class="p-3 messages">
            </div>
            <!-- end::messages -->

            <!-- begin::chat footer -->
            <div class="chat-footer">
                <form class="d-flex">
                    <div class="flex-shrink-0 dropdown me-3">
                        <button class="btn btn-primary btn-rounded" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Add Emoji</a>
                            <a href="#" class="dropdown-item">Attach files</a>
                        </div>
                    </div>
                    <input type="text" class="form-control text-msg-chat" autofocus placeholder="Write message...">
                    <button class="flex-shrink-0 btn btn-primary btn-rounded ms-3 btn-send-chat">Send</button>
                </form>
            </div>
            <!-- end::chat footer -->

        </div>
    </div>
    <!-- begin::chat content -->
@endsection

@section("script")
<script  type="module" src="{{ url('dashboard/js/examples/chat.js') }}"></script>
@endsection
