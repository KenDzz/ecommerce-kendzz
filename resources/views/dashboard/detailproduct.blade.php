@extends('dashboard.layout')

@section('content')
    <div class="mb-4 card">
        <div class="card-body">
            <h6 class="mb-4 card-title">Cập nhật sản phẩm</h6>
            <form class="form-add-product">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input name="id" id="id-product"  type="text" class="form-control" value="{{ $product->id }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input name="name" type="text" class="form-control" value="{{ $product->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Liên kết</label>
                            <input type="text" class="form-control" value="{{ $product->slug }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giảm giá(Tính theo % - tối đa 100 tương ứng 100%)</label>
                            <input name="discount" type="number" class="form-control" value="{{ $product->discount }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cân nặng(Tính bằng KG để check giá vận chuyển)</label>
                            <input name="weight" type="text" class="form-control" value="{{ $product->weight }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Giá <span class="label-price">({{ app('App\Http\Controllers\HomeController')->formatCurrency($product->price, 0) }})</span></label>
                            <input name="price" id="price-dashboard" class="form-control" value="{{ $product->price }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục sản phẩm</label>
                            <select class="form-select" name="category">
                                @foreach ($categorys as $data)
                                    <option value="{{ $data->id }}" {{ $product->category_id == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số lượng sản phẩm</label>
                            <input name="quantity" type="number" class="form-control" value="{{ $product->quantity }}">
                        </div>

                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Chi tiết sản phẩm </label>
                        <textarea id="editor" class="mt-1">{!! $product->describes !!}</textarea>
                    </div>

                    <div class="mt-5 col-md-12">
                        <div
                            class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="cover-photo" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Hình ảnh sản phẩm </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div id="lightgalleryImgProduct"  class="row">
                                    @if (!empty($product->productMedia) && $product->productMedia->count())
                                        @foreach ($product->productMedia as $key => $productMedia)
                                            <div class="card col-md-4 m-2" style="width: 18rem;">
                                                <img class="card-img-top" src="{{ $productMedia->url }}">
                                                <div class="card-body">
                                                <button type="button" attr-id="{{ $productMedia->id }}" class="btn btn-danger btn-action-delete-imgage ">Xóa ảnh</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 col-md-12">
                        <div class="row pt-3 border-top border-gray-200">
                            <label for="cover-photo" class="col-form-label col-sm-3 text-gray-700">
                                Hình ảnh
                            </label>
                            <div class="col-sm-9">
                                <div class="mt-1">
                                    <div class="d-flex justify-content-center align-items-center border-dashed border border-2 border-gray-300 border-dashed rounded p-5">
                                        <div class="text-center">

                                            <svg class="mx-auto mb-3" width="48" height="48"  stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                            <div class="mb-3">
                                                <label for="file-upload" class="btn btn-outline-primary btn-sm">
                                                    <span>Thêm ảnh sản phẩm</span>
                                                    <input id="file-upload" class="d-none" name="file-upload" type="file" class="sr-only">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
