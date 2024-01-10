@extends('dashboard.admin.layout.layout')

@section('content')
    <div class="mb-4 card">
        <div class="card-body">
            <h6 class="mb-4 card-title">Thông tin người bán
                @if ($seller->is_verified == 0)
                    <span class="badge text-bg-warning">Chờ xét duyệt</span>
                @elseif ($seller->is_confirm == 1)
                    <span class="badge text-bg-success">Đã xét duyệt</span>
                @else
                    <span class="badge text-bg-success">Không đủ điều kiện</span>
                @endif
            </h6>
            <form class="form-add-product">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input name="id" id="id-product"  type="text" class="form-control" value="{{ $seller->id }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên cửa hàng</label>
                            <input name="name" type="text" class="form-control" value="{{ $seller->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Họ (Thông tin người bán)</label>
                            <input type="text" class="form-control" value="{{ $seller->last_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên (Thông tin người bán)</label>
                            <input type="text" class="form-control" value="{{ $seller->first_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ (Thông tin người bán)</label>
                            <input  type="text" class="form-control" value="{{ $seller->address }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phường/Xã (Thông tin người bán)</label>
                            <input  type="text" class="form-control" value="{{ $seller->district }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quận/Huyện (Thông tin người bán)</label>
                            <input  type="text" class="form-control" value="{{ $seller->city }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tỉnh/Thành Phố (Thông tin người bán)</label>
                            <input  type="text" class="form-control" value="{{ $seller->province }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại (Thông tin người bán)</label>
                            <input  type="text" class="form-control" value="{{ $seller->phone }}">
                        </div>
                    </div>
                    <div class="mt-3 col-md-12">
                        <a href="{{ route('dashboard-admin-ekyc-confirm', ['id'=>$seller->id, 'status' => 1]) }}" class="btn btn-success btn-icon btn-product-confirm">
                            <i class="bi bi-check-circle"></i> Duyệt
                        </a>
                        <a href="{{ route('dashboard-admin-ekyc-confirm', ['id'=>$seller->id, 'status' => 2]) }}" class="btn btn-danger btn-icon btn-product-danger">
                            <i class="bi bi-check-circle"></i> Không đủ điều kiện
                        </a>
                    </div>
                </div>
                <div class="pt-4 mt-5 row border-top">
                    @foreach ($seller->ekyc as $data)
                        <h6 class="mb-4 card-title">Thông tin xác minh - {{ $data->created_at }}</h6>
                        <div class="col-md-6">
                            <label class="form-label">Tên (Thông tin trích xuất từ CMND)</label>
                            <input  type="text" class="form-control" value="{{ $data->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mã CMND (Thông tin trích xuất từ CMND)</label>
                            <input  type="text" class="form-control" value="{{ $data->code }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ngày sinh (Thông tin trích xuất từ CMND)</label>
                            <input  type="text" class="form-control" value="{{ $data->birthday }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giới tính (Thông tin trích xuất từ CMND)</label>
                            <input  type="text" class="form-control" value="{{ $data->sex }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nguyên quán (Thông tin trích xuất từ CMND)</label>
                            <input  type="text" class="form-control" value="{{ $data->addressone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Thường trú (Thông tin trích xuất từ CMND)</label>
                            <input  type="text" class="form-control" value="{{ $data->addresssecond }}">
                        </div>
                    @endforeach
                </div>
                <div class="pt-4 mt-5 row border-top">
                    @foreach ($seller->logEkyc as $data)
                        <h6 class="mb-4 card-title">Thông tin trích xuất - {{ $data->created_at }}</h6>
                        <div class="col-md-12">
                            <label class="form-label">Thông tin trích xuất (Thông tin trích xuất từ CMND)</label>
                            <textarea class="form-control" v>{{ $data->text }}</textarea>
                        </div>
                    @endforeach
                </div>
                <div class="pt-4 mt-5 row border-top">
                    @if (!empty($seller->ekycMedia) && $seller->ekycMedia->count())
                        @foreach ($seller->ekycMedia as $key => $ekycMedia)
                            @if ($ekycMedia->type == 2)
                                <div class="col-md-4">
                                    <h6 class="mb-4 card-title">Hình ảnh được tải lên- {{ $data->created_at }}</h6>

                                    <img class="card-img-top" src="{{ $ekycMedia->url }}">
                                </div>
                            @endif

                        @endforeach
                    @endif
                </div>
                <div class="pt-4 mt-5 row border-top">
                    @if (!empty($seller->ekycMedia) && $seller->ekycMedia->count())
                        @foreach ($seller->ekycMedia as $key => $ekycMedia)
                            @if ($ekycMedia->type == 0)
                                <div class="col-md-4">
                                    <h6 class="mb-4 card-title">Hình ảnh được xử lý Lần 1 - {{ $data->created_at }}</h6>
                                    <img class="card-img-top" src="{{ $ekycMedia->url }}">
                                </div>
                            @endif

                        @endforeach
                    @endif
                </div>
                <div class="pt-4 mt-5 row border-top">
                    @if (!empty($seller->ekycMedia) && $seller->ekycMedia->count())
                        @foreach ($seller->ekycMedia as $key => $ekycMedia)
                            @if ($ekycMedia->type == 1)
                                <div class="col-md-4">
                                    <h6 class="mb-4 card-title">Hình ảnh được xử lý Lần 2 - {{ $data->created_at }}</h6>

                                    <img class="card-img-top" src="{{ $ekycMedia->url }}">
                                </div>
                            @endif

                        @endforeach
                    @endif
                </div>
                <div class="pt-4 mt-5 row border-top">
                    @if (!empty($seller->ekycMedia) && $seller->ekycMedia->count())
                        @foreach ($seller->ekycMedia as $key => $ekycMedia)
                            @if ($ekycMedia->type == 3)
                                <div class="col-md-4">
                                    <h6 class="mb-4 card-title">Hình ảnh được xử lý Lần 3 - {{ $data->created_at }}</h6>
                                    <img class="card-img-top" src="{{ $ekycMedia->url }}">
                                </div>
                            @endif

                        @endforeach
                    @endif
                </div>
                <div class="pt-4 mt-5 row border-top">
                    @if (!empty($seller->ekycMedia) && $seller->ekycMedia->count())
                        @foreach ($seller->ekycMedia as $key => $ekycMedia)
                            @if ($ekycMedia->type == 4)
                                <div class="col-md-4">
                                    <h6 class="mb-4 card-title">Hình ảnh xác minh chân dung- {{ $data->created_at }}</h6>
                                    <img class="card-img-top" src="{{ $ekycMedia->url }}">
                                </div>
                            @endif

                        @endforeach
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="module" src="{{ url('dashboard/js/examples/chat.js') }}"></script>
@endsection
