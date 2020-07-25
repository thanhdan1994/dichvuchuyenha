@extends('app')

@section('content')
    <div class="main-content">
        <div class="crumb hide-on-mobile">
            <div class="grid bb">
                <a href="/">Trang chủ</a>
                <a href="javascript: void(0)">Giới Thiệu </a>
            </div>
        </div>
        <div class="grid">
            <div class="flex-container">
                <div class="cell-1-4 leftpage">
                    <div class="c20"></div>
                    <div class="c10"></div>
                    <h2 class="title-left bgblue"><a href="javascript: void(0)">Góc tư vấn</a></h2>
                    <div class="box-border-left">
                        @foreach($advisoryPosts as $post)
                        <div class="item-news-left">
                            <a href="{{ route('post.show', $post->slug) }}">{{$post->name}} </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="c10"></div>
                    <h2 class="title-left bgblue"><a href="javascript: void(0)">Tin tức nổi bật</a></h2>
                    <div class="box-border-left">
                        @foreach($priorityPosts as $post)
                            <div class="item-news-left">
                                <a href="{{ route('post.show', $post->slug) }}">{{$post->name}} </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="cell-3-4 rightpage">
                    <h1 class="page-name"><span>Giới Thiệu </span></h1>
                    <div class="c15"></div>
                    <div class="content-detail"><p><br>
                            <br>
                            <strong>Chào mừng quý khách hàng đến với các dịch vụ vận tải bằng xe taxi tải chuyển nhà&nbsp;Tín Phát!</strong></p>
                        <p>Lời đầu tiên thay mặt toàn thể cán bộ, công nhân viên Công ty chuyển nhà trọn gói Tín Phát&nbsp;xin gửi đến quý khách hàng lời chào mừng trân trọng nhất và gửi lời cám ơn chân thành đến quý khách hàng đã và đang tin tưởng sử dụng các Dịch vụ chuyển nhà trọn gói, Vận chuyển nhà trọn gói, Vận chuyển hàng hóa trong nước, Dịch vụ taxi tải, Dịch vụ&nbsp;chuyển văn phòng trọn gói của&nbsp;<strong>Tín Phát</strong>.</p>
                        <p>– Nhắc đến Dịch vụ chuyển nhà trọn gói&nbsp;<strong>Tín Phát</strong>&nbsp;khách hàng cảm thấy hài lòng&nbsp;bởi năng lực, cống hiến, sự sáng tạo, và sự phục vụ nhiệt tình tận tuỵ của toàn thể cán bộ nhân viên công ty dịch vụ chuyển nhà Tín Phát đến với mọi khách hàng trên địa bàn TPHCM.&nbsp;<strong>Tín Phát</strong>&nbsp;luôn tự hào là nhà cung cấp dịch vụ Vận tải hàng hóa – Dịch vụ Chuyển nhà trọn gói – dịch vụ chuyển Văn phòng trọn gói Hàng đầu tại Việt Nam với giá rẻ và chất lượng từ dịch vụ mang lại cho khách hàng.</p>
                        <p>– Với thương hiệu Taxi tải dịch vụ chuyển nhà&nbsp;<strong>Tín Phát</strong>, chúng tôi luôn mong muốn đem lại giá trị cho khách hàng những dịch vụ chuyển nhà, văn phòng hay dịch vụ vận chuyển tốt nhất. Tín Phát Luôn đặt quyền lợi khách hàng lên trên hết, vì thế mà trong nhiều năm qua Dịch vụ chuyển nhà&nbsp;<strong>Tín Phát</strong>&nbsp;đã đạt được những thành quả, lòng tin, uy tín nhất định từ phía khách hàng dành cho chúng tôi trong những năm qua.</p>
                        <p>– Khi xã hội càng phát triển, nhu cầu nâng cao điều kiện, môi trường làm việc đã khiến các hộ gia đình, doanh nghiệp ngày càng có xu hướng thay đổi và nâng cấp nhà ở và văn phòng làm việc. Mỗi khi có sự thay đổi đó thì ta phải chuyển nhà – chuyển văn phòng đến địa chỉ mới rất mất nhiều thời gian quý báu của từng thành viên trong gia đình và với cơ quan doanh nghiệp cũng vậy. Trước tình hình đó Công ty TNHH&nbsp;dịch vụ vận tải&nbsp;<strong>Tín Phát</strong>&nbsp;đã cho ra đời dịch vụ Chuyển nhà – Chuyển văn phòng trọn gói. Với đội ngũ nhân viên được đào tạo bài bản, quy trình chất lương được tuân thủ tuyệt đối với đội ngũ giám sát chuyên nghiệp, đã được đúc kết kinh nghiệm qua việc đã triển khai hàng ngàn hợp đồng chuyển nhà, chuyển văn phòng, cho hàng ngàn Hộ gia đình, Cơ quan, Doanh nghiệp tại Thành phố Hồ Chí Minh.</p>
                        <p><strong>Phương tiện trang bị đầy đủ</strong></p>
                        <p>Xe cẩu, xe nâng, xe đẩy, xe kéo, xe tải lớn nhỏ<br>
                            Xe taxi tải chuyên chở phục vụ 24/7&nbsp;gọi là có<br>
                            Đội ngũ thợ kỹ thuật, tháo ráp đồ chuyên nghiệp, có bề dày kinh nghiệp, cẩn thận, chu đáo, nhiệt tình.<br>
                            Đội ngũ bốc xếp được đào tạo nghiệp vụ, có phẩm chất đạo đức tốt, nhiệt tình vui vẻ.<br>
                            <strong>Năng lực</strong></p>
                        <p>Công ty Cổ phần thương mại và dịch vụ vận tải&nbsp;<strong>Tín Phát</strong>&nbsp;có 9&nbsp;năm hoạt động trong nghề, có bề dày kinh nghiệm trong lĩnh vực vận chuyển hàng hóa. Trong suốt quá trình hoạt động công ty đã không ngừng phát triển và củng cố chất lượng dịch vụ. Chúng tôi đã nhận và vận chuyển di dời nhiều công trình lớn nhỏ, trụ sở làm việc, văn phòng, kho bãi, xưởng sản xuất, nhà ở. Vận chuyển hàng hóa đi các nơi trong TP Hồ Chí Minh&nbsp;và các tỉnh thành trong cả nước. Công ty chúng tôi đã nhận được sự tin cậy và ủng hộ nhiệt tình đông đảo từ phía khách hàng đã sử dụng dịch vụ<br>
                            <br>
                            - Công ty Dịch vụ chuyển nhà Tín Phát cam kết:<br>
                            <br>
                            Hoàn tiền 100% nếu khách hàng không hài lòng với chất lượng dịch vụ chuyển nhà, chuyển nhà trọn gói, chuyển văn phòng trọn gói.&nbsp;<br>
                            Đền bù 100% giá trị tài sản, hàng hóa nếu trong quá trình thực hiện công việc có xảy ra hư hại, thất lạc đồ đạc của khách hàng.&nbsp;<br>
                            &nbsp;</p>
                        <p><strong>CÔNG TY TNHH&nbsp;DỊCH VỤ VẬN TẢI&nbsp;Tín Phát</strong></p>
                        <p>Địa chỉ : {{$addressGlobal}}</p>
                        <p>Điện thoại : {{$phoneGlobal}}</p>
                        <p>Website: chuyennhatinphat.vn</p>
                        <p>Email: {{$emailGlobal}}</p>
                        <h3>&nbsp;</h3>
                    </div>
                    <div class="c20"></div>
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <!-- AddThis Button END -->
                    <div class="c20"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
