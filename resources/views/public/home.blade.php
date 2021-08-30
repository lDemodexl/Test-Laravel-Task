@extends('layouts.public_base')

@section('content')
<section class="container">
    <div class="row">
        <div class="col-12">
            <form action="" method="post" class="border border-white border-3 p-3" id="add_domains_form">
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
                                <button class="btn btn-primary" id="add_domain_to_list">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-3">
                        <div id="domain_list" class="border border-light p-3">

                        </div>
                    </div>
                </div>
                <div class="row" id="form_action_buttons" style="display:none">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-success me-3">Proceed</button>
                        <button class="btn btn-danger" id="clear_list">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
