@extends('backend.layout.app') 

    @section('content')
           <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

                <div class="content">
                <div class="page-header">
                    <div class="page-title">
                    <h4>Product List</h4>
                    <h6>Manage your Product</h6>
                    </div>
                    <div class="page-btn">
                    <a href="{{route('product.create')}}" class="btn btn-added">
                        <img src="{{asset('theme/assets/img/icons/plus.svg')}}" class="me-2" alt="img">Add Product </a>
                    </div>
                </div>

                    <!-- Start Content-->
                    <!-- <div class="container-fluid">

                        <div class="row"> -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="responsive-table-plugin" style="padding-bottom: 15px;">
                                        @if (Session::has('success'))
                                            <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong>Success!</strong> {{Session::get('success')}}
                                        </div>    
                                        @endif
                                        <div id="gridContainer"></div>
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive" data-pattern="priority-columns">
                                            
                                                <!-- <table id="tech-companies-1" class="table table-striped mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th data-priority="1">Name</th>
                                                        <th>Category</th>
                                                        <th>Brand</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Tax (%)</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                       
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (isset($products))
                                                           
                                                       
                                                        @foreach ($products as $pp)
                                                          
                                                     
                                                    <tr>
                                                        <th>{{$pp->id}}</th>
                                                        <td>{{uppercase($pp->name)}}</td>
                                                        <td>{{$pp->category->name}}</td>
                                                        <td>{{$pp->brand->name}}</td>
                                                        <td>{{$pp->price}}</td>
                                                        <td>{{$pp->quantity}}</td>
                                                        <td>{{$pp->tax}}</td>
                                                        <td><span class="badge badge-{{check_class($pp->status)}}">{{uppercase(check_status($pp->status))}}</span></td>
                                                       
                                                        <td><a href="{{url('product/'.$pp->id.'/edit')}}" class="btn btn-bordred-primary waves-effect  width-md waves-light">Edit</a></td>
                                                        <td><p  onclick="event.preventDefault();document.getElementById('del-form-{{$pp->id}}').submit()" class="btn btn-bordred-danger waves-effect  width-md waves-light">Delete</p></td>

                                                        <form id="del-form-{{$pp->id}}" action="{{url('product/'.$pp->id)}}" method="POST" style="display:none;">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$pp->id}}">
                                                           
                                                        </form>
                                                        

                                                       
                                                    </tr>
                                                      @endforeach

                                                       @endif
                                                    </tbody>
                                                </table> -->
                                            </div>


    
                                        </div>

                                    </div>
                                    {{$products->links()}}
                                </div>

                            <!-- </div>
                        </div> -->
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

               

      @endsection()

      @section('script')
        <script>
            var instance = null;

$(() => {
function isNotEmpty(value) {
 return value !== undefined && value !== null && value !== '';
}
//   Globalize.culture().numberFormat.currency.symbol = "Rs.";

const store = new DevExpress.data.CustomStore({
 key: 'id',
 load(loadOptions) {
   const deferred = $.Deferred();
   const args = {};

   [
     'skip',
     'take',
     'requireTotalCount',
     'requireGroupCount',
     'sort',
     'filter',
     'totalSummary',
     'group',
     'groupSummary',
   ].forEach((i) => {
     if (i in loadOptions && isNotEmpty(loadOptions[i])) {
       args[i] = JSON.stringify(loadOptions[i]);
     }
   });
   $.ajax({
     url: "{{url('product_json')}}",
     dataType: 'json',
     data: args,
     success(result) {
       deferred.resolve(result.data, {
         totalCount: result.totalCount,
         summary: result.summary,
         groupCount: result.groupCount,
       });
     },
     error() {
       deferred.reject('Data Loading Error');
     },
     timeout: 5000,
   });

   return deferred.promise();
 },
});

instance = $('#gridContainer').dxDataGrid({
 dataSource: store,
 allowColumnReordering: true,
 allowColumnResizing: true,
 columnAutoWidth: true,
 showBorders: true,
 showColumnLines:true,
 showRowLines: true,
 rowAlternationEnabled: true,
 showClearButton: true,
 columnChooser: {
   enabled: true,
 },
 columnFixing: {
   enabled: true,
 },
 remoteOperations: true,
 paging: {
   pageSize: 10,
 },
 pager: {
   visible: true,
   allowedPageSizes: [10, 20, 50, 100],
   showPageSizeSelector: true,
   showInfo: true,
   showNavigationButtons: true,
 },
 export: {
         enabled: true,
         fileName: "Sale Order Summary",
         title: 'Export to excel'
 },
 filterRow: {
   visible: true,
   applyFilter: 'auto',
 },
 searchPanel: {
   visible: true,
   width: 240,
   placeholder: 'Search...',
 },
 headerFilter: {
   visible: true,
 },
 columns: [ {
   dataField: 'id',
   calculateCellValue: function(rowData) {
             return rowData.id;
     },
   dataType: 'number',
   allowFiltering:true,
   sortOrder: "desc",
     width: 100,
 },
 {
   dataField: 'name',
   dataType: 'string',
   caption:"Product Name",
   showClearButton: true,
 }],
}).dxDataGrid('instance');
});
        </script>
      @endsection()