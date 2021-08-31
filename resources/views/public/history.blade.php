@extends('layouts.public_base')

@section('css-container')
    <link href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('js-container')
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#domains_table').DataTable();
        })
    </script>
@endsection


@section('content')
<section class="container">
    <div class="row">
        <div class="col-12">
            <table id="domains_table" >
                <thead>
                    <tr>
                        <td>Domain</td>
                        <td>IP</td>
                        <td>Created At</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $domain)
                    <tr>
                        <td>{{ $domain->domain }}</td>
                        <td>
                            @if ( $domain->domain == $domain->fetche_id )
                                <span class="badge bg-danger">Not Found</span>
                            @else
                                @if ( !empty($domain->fetched_id) )
                                    <span class="badge bg-success">{{ $domain->fetched_id }}</span>
                                @else
                                    <span class="badge bg-primary">In Queue</span>
                                @endif
                            @endif
                        </td>
                        <td>{{ $domain->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
