@extends('dashboard.admin.layout.layout')

@section('content')
<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Quản lý EKYC</h1>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <!-- Replace with your content -->
        <div class="py-4 mt-5">
            <div class="w-full max-w-full mt-5">
                <div class="relative flex flex-col min-w-0 p-5 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                  <div class="table-responsive">
                    <table  id="product-data"  class="table table-flush text-slate-500" datatable id="datatable-search">
                      <thead class="thead-light">
                        <tr>
                          <th>Tên sản phẩm</th>
                          <th>Đánh giá</th>
                          <th>Tình trạng</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sellers as $seller)
                            <tr>
                            <td class="text-truncate" style="max-width: 150px;">{{ $seller->name }}</td>
                            <td class="text-truncate">{{ $seller->rate }}</td>
                            <td class="text-truncate">
                                @if ($seller->is_verified == 0)
                                    <span class="badge text-bg-warning">Chờ xét duyệt</span>
                                @elseif ($seller->is_verified == 1)
                                    <span class="badge text-bg-success">Đã xét duyệt</span>
                                @else
                                    <span class="badge text-bg-success">Không đủ điều kiện</span>
                                @endif
                            </td>
                            <td class="text-sm font-normal leading-normal">
                                <a href="{{ route('dashboard-admin-ekyc-detail', ['id' => $seller->id]) }}" class="btn btn-primary btn-icon">
                                    <i class="bi bi-plus-circle"></i> Cập nhật EKYC
                                </a>
                            </td>

                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
        <!-- /End replace -->
    </div>
</div>
@endsection
