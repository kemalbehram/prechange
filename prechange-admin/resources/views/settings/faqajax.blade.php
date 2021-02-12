    <div class="table-responsive search_result">
        @if($faq->count())
        <table class="table" id="dows">
          <thead>
            <tr>
              <th>S.No</th>
              
              <th>Header</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($faq as $key => $user)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $user->title }}</td>
              <td>{{ $user->description }}</td>
              <td><a class="btn btn-success btn-xs" href="{{ url('admin/faq_edit/'.$user->id) }}"><i class="zmdi zmdi-edit"></i> View </a> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else 
        {{ 'No record found! ' }}
        @endif
      </div>