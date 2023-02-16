@push('after-styles')
<link href="{{ URL::asset('/admincss/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@extends('admin.layouts.app')
@section('title', 'Products')
@section('content')


<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Products</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </div>
                </div>

            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Products</h4>
                                <div class="text-right">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm scroll-click" >
                                create</a>
                            </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Brand Name</th>
                                                <th>Category Name</th>
                                                <th>SubCategory Name</th>
                                                <th>ChildCategory Name</th>
                                                <th>SubChildCategory Name</th>
                                                <th>Product Name</th>
                                                <th>Stock Status</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach ($data as $row)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>@if($row->brands != null){{$row->brands->brand_name}}@endif</td>
                                                <td>@if($row->category != null){{$row->category->cat_name}}@endif</td>
                                                <td>@if($row->subcategory != null){{$row->subcategory->subcat_name}}@endif</td>
                                                <td>@if($row->childcategory != null){{$row->childcategory->childcat_name}}@endif</td>
                                                <td>@if($row->subchildcategory != null){{$row->subchildcategory->subchildcat_name}}@endif</td>
                                                <td>{{@$row->product_name }}</td>
                                                <td>{{@$row->stock_status}}</td>
                                                <td>{{@$row->status}}</td>
                                                <td>
                                                    <a href="{{ route('admin.products.edit', $row->id) }}" class="btn btn-primary">Edit</a>
                                                    <button form="resource-delete-{{ $row->id }}" class="btn btn-danger btn-icon-style-2"><span>Delete</span></button>
                                                    <form id="resource-delete-{{ $row->id }}" action="{{ route('admin.products.destroy', $row->id) }}" style="display: inline-block;" onSubmit="return confirm('Are you sure you want to delete this item?');" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    </form>
                                                    @if($row->is_variation	== '1')
                                                 <!--   <a  href="{{ url('/') }}/admin/variations/addvariants/{{ $row->id }}" class="btn btn-primary">Add Variation</a>-->
                                                     <a  href="{{ url('/') }}/admin/variations/create/{{ $row->id }}" class="btn btn-primary">Add Variation</a>
                                                   @endif
                                                   @if($row->is_combo	== '1')
                                                   <!--   <a  href="{{ url('/') }}/admin/variations/addvariants/{{ $row->id }}" class="btn btn-primary">Add Variation</a>-->
                                                       <a  href="{{ url('/') }}/admin/combo/create/{{ $row->id }}" class="btn btn-primary">Add Combos</a>
                                                     @endif
                                                  </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Brand Name</th>
                                                <th>Category Name</th>
                                                <th>SubCategory Name</th>
                                                <th>ChildCategory Name</th>
                                                <th>SubChildCategory Name</th>
                                                <th>Product Name</th>
                                                <th>Stock Status</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                    </div>
            </div>
       </div>

</div>
</div>
</div>




    @push('after-scripts')
 <!-- Datatable -->
 <script src="{{ URL::asset('/admincss/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('/admincss/js/plugins-init/datatables.init.js')}}"></script>


@endpush

@endsection
