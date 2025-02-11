@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle overflow-hidden me-6">
                                    <img src="{{ asset('assets/dist/images/profile/empty-user.jpg') }}" alt=""
                                        width="40" height="40">
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">Selamat Datang {{ auth()->user()->name }}!</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <p>Selamat datang di halaman admin! Kelola data, pantau aktivitas, dan optimalkan sistem dengan mudah dan efisien.</p>
                            </div>

                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/welcome-bg.svg"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">$10,230</h4>
                    <p class="mb-2 fs-3">Expense</p>
                    <div id="expense"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">$65,432</h4>
                    <p class="mb-1 fs-3">Sales</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Product Performances</h5>
                            <p class="card-subtitle">What Impacts Product Performance?</p>
                        </div>
                        <div>
                            <select class="form-select fw-semibold">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Assigned</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Chart</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-1.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Minecraf App</h6>
                                                <p class="fs-2 mb-0 text-muted">Jason Roy</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">73.2%</p>
                                    </td>
                                    <td>
                                        <span class="badge fw-semibold py-1 w-85 bg-light-success text-success">Low</span>
                                    </td>
                                    <td>
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td>
                                        <div id="table-chart"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-2.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Web App Project</h6>
                                                <p class="fs-2 mb-0 text-muted">Mathew Flintoff</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">56.8%</p>
                                    </td>
                                    <td>
                                        <span
                                            class="badge fw-semibold py-1 w-85 bg-light-warning text-warning">Medium</span>
                                    </td>
                                    <td>
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td>
                                        <div id="table-chart-1"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-3.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Modernize Dashboard</h6>
                                                <p class="fs-2 mb-0 text-muted">Anil Kumar</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">25%</p>
                                    </td>
                                    <td>
                                        <span class="badge fw-semibold py-1 w-85 bg-light-info text-info">Very high</span>
                                    </td>
                                    <td>
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td>
                                        <div id="table-chart-2"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0 border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-4.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Dashboard Co</h6>
                                                <p class="fs-2 mb-0 text-muted">George Cruize</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fs-3 text-dark">96.3%</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">High</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div id="table-chart-3"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-cart.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="sales-two" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">$16.5k<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Sales</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-info rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-bar.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="growth" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">24%<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Growth</p>
                        </div>
                    </div>
                </div>
            </div>

        </div> --}}


    </div>
@endsection
