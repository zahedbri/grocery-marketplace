@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('penjual.dashboard')}}" class="breadcrumb-item">Dashboard</a>
            <span class="breadcrumb-item active">Permintaan</span>
        </nav>
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <h1 class="mt-2">Permintaan Toko Anda</h1>
        <table class="table w-100 table-striped">
            <thead>
                <th>Pembeli</th>
                <th>Kota</th>
                <th>Tanggal Pemesanan</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @forelse($permintaan as $item)
                <tr>
                    <td>{{$item->pembeli->user->nama}}</td>
                    <td>{{$item->pembeli->kota}}</td>
                    <td>{{$item->tanggalPemesanan()}}</td>
                    <td>
                        <a href="{{route('permintaan.detail',[$item->id])}}" class="btn btn-outline-info"><i class="fas fa-clipboard"></i> Detail Transaksi</a>
                        <button data-url="{{route('permintaan.proses',[$item->id])}}" class="btn btn-confirm btn-outline-success"><i class="fas fa-check-circle"></i> Proses</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <h5 class="text-center">Anda belum memiliki permintaan aktif.</h5>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <form id="confirm-order" action="" method="POST">@csrf</form>
    </div>
@endsection

@section('js')
    <script>
        $('.btn-confirm').click(function(){
            swal({
                title: "Proses Pesanan",
                text: "Anda ingin memproses Pesanan?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('form#confirm-order');
                    formdel.attr('action',$(this).data('url'));
                    formdel.submit();
                }
            });
        });
    </script>
@endsection