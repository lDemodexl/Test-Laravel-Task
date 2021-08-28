@extends('layouts.public_base')

@section('content')
<section class="container">
    <div class="row">
        <div class="col-12">
            <form action="" method="post" class="border border-white border-3 p-3">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 p-3">
                        <div class="mb-3 row border border-light p-3">
                            <label for="inputPassword" class="col-12 col-form-label">Fill in domain</label>
                            <div class="col-sm-12">
                                <input
                                    type="url"
                                    class="form-control"
                                    id="url_input"
                                    placeholder="https://example.com"
                                    pattern="https?://.+\.\w{2,}">
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-3">
                        <div id="domain_list border border-dark">

                        </div>
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-success me-3">Proceed</button>
                        <button class="btn btn-danger">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
