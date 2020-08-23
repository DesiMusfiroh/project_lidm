@extends('layouts.layout_guru')

@section('title')
    <title>Unbreakable</title>
@endsection
@section('content')


  <main class="main">
        <div>
            {{ Breadcrumbs::render('home') }}
        </div>
      <div class="container-fluid">

                            <div class="divider mt-0" style="margin-bottom: 30px;">&nbsp;</div>
                            <div class="row">
                                <div class="col-lg-6 col-xl-4">
                                    <div class="card mb-3 widget-content bg-night-fade">
                                        <div class="widget-content-wrapper text-white">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Jumlah Kelas</div>
                                                <div class="widget-subheading">Last year expenses</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-white"><span>1896</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="card mb-3 widget-content bg-arielle-smile">
                                        <div class="widget-content-wrapper text-white">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Jumlah Siswa</div>
                                                <div class="widget-subheading">Total Clients Profit</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-white"><span>$ 568</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="card mb-3 widget-content bg-premium-dark">
                                        <div class="widget-content-wrapper text-white">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Jumlah Ujian</div>
                                                <div class="widget-subheading">Total revenue streams</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-warning"><span>$14M</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
      </div>
  </main>

@endsection
