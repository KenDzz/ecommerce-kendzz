@extends('dashboard.admin.layout.layout')

@section('content')
    <div class="mb-4 card">
        <div class="card-body">
            <h6 class="mb-4 card-title">Cập nhật sản phẩm
                @if ($product->is_confirm == 1)
                    <span class="badge text-bg-warning">Chờ xét duyệt</span>
                @elseif ($product->is_confirm == 2)
                    <span class="badge text-bg-success">Đã xét duyệt</span>
                @else
                    <span class="badge text-bg-danger">Vi phạm chính sách</span>
                @endif
            </h6>
            @if (count($badwords) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Hệ thống quét tự động:</strong> Tìm thấy từ ngữ <strong>{{ implode(",",$badwords) }}</strong> vi phạm trong tên và mô tả của sản phẩm
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Hệ thống quét tự động:</strong> Không tìm thấy từ ngữ vi phạm
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
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
                                            <div class="m-2 card col-md-4" style="width: 18rem;">
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
                        <div class="pt-3 border-gray-200 row border-top">
                            <label for="cover-photo" class="text-gray-700 col-form-label col-sm-3">
                                Hình ảnh
                            </label>
                            <div class="col-sm-9">
                                <div class="mt-1">
                                    <div class="p-5 border border-2 border-gray-300 border-dashed rounded d-flex justify-content-center align-items-center">
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
                        <a href="{{ route('dashboard-admin-product-confirm-update', ['id'=>$product->id, 'status' => 2]) }}" class="btn btn-success btn-icon btn-product-confirm">
                            <i class="bi bi-check-circle"></i> Không vi phạm
                        </a>
                        <a href="{{ route('dashboard-admin-product-confirm-update', ['id'=>$product->id, 'status' => 3]) }}" class="btn btn-danger btn-icon btn-product-danger">
                            <i class="bi bi-check-circle"></i> Vi Phạm
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="module" src="{{ url('dashboard/js/examples/chat.js') }}"></script>
@endsection
