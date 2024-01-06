@extends('dashboard.layout')

@section('content')
    <div class="mb-4 card">
        <div class="card-body">
            <h6 class="mb-4 card-title">Thêm sản phẩm</h6>
            <form class="form-add-product">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Liên kết</label>
                            <input type="text" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giảm giá(Tính theo % - tối đa 100 tương ứng 100%)</label>
                            <input name="discount" type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cân nặng(Tính bằng KG để check giá vận chuyển)</label>
                            <input name="weight" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Giá <span class="label-price"></span></label>
                            <input name="price" id="price-dashboard" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục sản phẩm</label>
                            <select class="form-select" name="category">
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số lượng sản phẩm</label>
                            <input name="quantity" type="number" class="form-control">
                        </div>

                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Chi tiết sản phẩm </label>
                        <textarea id="editor" class="mt-1"></textarea>
                    </div>
                    <div class="mt-3 col-md-12">
                        <button class="btn btn-success btn-icon btn-add-product">
                            <i class="bi bi-check-circle"></i> Lưu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="module" src="{{ url('dashboard/js/examples/chat.js') }}"></script>
@endsection
