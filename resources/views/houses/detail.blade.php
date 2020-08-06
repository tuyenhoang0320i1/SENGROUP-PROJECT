@extends('layout.master')
@section('content')
    <div class="pb-5">
        <div class="container pt-3">
            <div class="card">
                <div class="card-body">
                    <div class="site-section" id="property-details">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="owl-carousel slide-one-item with-dots">
                                        @foreach($house->images as $image)
                                            <span id="zoom"><img src="{{asset('storage/'.$image->image)}}"
                                                                 class="img-fluid"
                                                                 style="width: 100%;height: 700px"></span>
                                        @endforeach
                                    </div>
                                    @if(Session::get('user'))
                                    <div class="form-group" style="margin-top: 50px;margin-bottom: 20px">
                                        <form action="{{route('post.comment',$house->id)}}" method="post">
                                            @csrf
                                        <label for="comment">Nhận xét:</label>
                                        <textarea required class="form-control" name="comment" rows="2" id="comment"></textarea>
                                            <button type="submit" class="btn btn-outline-info" style="margin-top: 5px;float: right">Đăng</button>
                                        </form>
                                    </div>
                                    @else
                                        <div class="form-group" style="margin-top: 30px;padding-bottom: 25px">
                                            <form action="{{route('check.comment')}}" method="post">
                                                @csrf
                                                <label for="comment">Nhận xét:</label>
                                                <textarea required class="form-control" rows="2" id="comment"></textarea>
                                                <button onclick="return confirm('Đăng nhập để có thể bình luận ?')" class="btn btn-outline-info" style="margin-top: 5px;float: right">Đăng</button>
                                            </form>
                                        </div>
                                        @endif
                                    <div class="comment-widgets" style="margin-top: 10px">
                                        <!-- Comment Row -->
                                        @foreach($comments as $comment)
                                        <div class="d-flex flex-row comment-row m-t-5">
                                            <div class="p-2"><img src="{{asset('storage/images/'.$comment->user->image)}}" alt="user" width="50" class="rounded-circle"></div>
                                            <div class="comment-text w-100">
                                                <strong><h5 class="font-medium">{{$comment->user->name}}</h5></strong> <span class="m-b-15 d-block">{{$comment->content}}</span>
                                            </div>
                                        </div>
                                    @endforeach<!-- Comment Row -->
                                    </div>
                            </div>
                            <div class="col-lg-5 pl-lg-5 ml-auto">
                                <div class="mb-5">
                                    <h3 class="text-black mb-4"><i class='fas fa-tags'></i> &nbsp;{{$house->name}}.
                                    </h3>
                                    <h5><i class='fas fa-map-marker-alt'></i> &nbsp;{{$house->addresses[0]->road}},
                                        {{$house->addresses[0]->district}},
                                        {{$house->addresses[0]->city}}</h5>

                                    <h5 class="mb-2"><i class='fas fa-bed'></i> &nbsp; Số phòng
                                        ngủ: {{$house->rooms}} phòng.</h5><br>


                                    <p class="mb-1" id="editor"><i class='fas fa-list-alt'></i> &nbsp; Thông tin mô
                                        tả :{!! $house->desc !!}.</p>
                                    <h4 class="mb-1"><i class="fa fa-money "></i> &nbsp;Giá
                                        Tiền: {{number_format($house->price)}} VNĐ</h4>


                                        <ul class="alert text-danger" >
                                            @foreach ($errors ->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>

                                    <div class="pt-2">
                                        <button type="button"
                                                class="btn btn-primary @if((\Illuminate\Support\Facades\Session::get('user')) && (\Illuminate\Support\Facades\Session::get('user')->name)===($house->user->name))
                                                    d-none
@else
                                                    d-inline
@endif" data-toggle="modal"
                                                data-target="#exampleModal" data-whatever="@mdo">Đặt Thuê
                                        </button>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <form method="post" action="{{route('houses.bookHouse',$house->id)}}">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Đặt
                                                                nhà:</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">

                                                                <label for="recipient-name" class="col-form-label">Ngày
                                                                    Đến:</label>
                                                                <input type="date" class="form-control"
                                                                       id="recipient-name" name="dateIn">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Ngày
                                                                    Đi:</label>
                                                                <input class="form-control"
                                                                       id="message-text" type="date" name="dateOut">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Ghi
                                                                    Chú:</label>
                                                                <textarea class="form-control" name="note"
                                                                          id="desc"></textarea>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Thoát
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Đặt thuê
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <a href="{{route('houses.list')}}" class="btn btn-secondary">Quay Lại </a>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div class="mt-5">
                                        <img src="{{asset('storage/images/'.$house->user->image)}}" alt="Image"
                                             class="w-25 mb-3 " style="width: 100px;height: 100px">
                                        <h5 class="text-black"><i class='fas fa-user-edit'></i> &nbsp; Người
                                            Đăng: {{$house->user->name}}</h5>
                                        <p class="text-black"><i class='fas fa-phone-square-alt'></i> &nbsp;
                                            Phone: {{$house->user->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
