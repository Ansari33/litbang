@extends('layout')
@section('title')
    Profile - Definisi
@endsection
@section('content')
    <div class="content-wrap">
{{--        <div class="container clearfix">--}}

{{--            <div class="row col-mb-50">--}}
{{--                <div class="col-sm-6 col-lg-4">--}}
{{--                    <div class="feature-box fbox-border fbox-effect">--}}
{{--                        <div class="fbox-icon">--}}
{{--                            <a href="#"><i class="icon-screen i-alt"></i></a>--}}
{{--                        </div>--}}
{{--                        <div class="fbox-content">--}}
{{--                            <h3>Responsive Layout</h3>--}}
{{--                            <p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-6 col-lg-4">--}}
{{--                    <div class="feature-box fbox-border fbox-effect">--}}
{{--                        <div class="fbox-icon">--}}
{{--                            <a href="#"><i class="icon-eye i-alt"></i></a>--}}
{{--                        </div>--}}
{{--                        <div class="fbox-content">--}}
{{--                            <h3>Retina Ready Graphics</h3>--}}
{{--                            <p>Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Retina Icons, Fonts &amp; all others graphics are optimized.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-6 col-lg-4">--}}
{{--                    <div class="feature-box fbox-border fbox-effect">--}}
{{--                        <div class="fbox-icon">--}}
{{--                            <a href="#"><i class="icon-beaker i-alt"></i></a>--}}
{{--                        </div>--}}
{{--                        <div class="fbox-content">--}}
{{--                            <h3>Powerful Performance</h3>--}}
{{--                            <p>Canvas includes tons of optimized code that are completely customizable and deliver unmatched fast performance.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-6 col-lg-4">--}}
{{--                    <div class="feature-box fbox-border fbox-effect">--}}
{{--                        <div class="fbox-icon">--}}
{{--                            <a href="#"><i class="icon-stack i-alt"></i></a>--}}
{{--                        </div>--}}
{{--                        <div class="fbox-content">--}}
{{--                            <h3>Premium Sliders Included</h3>--}}
{{--                            <p>Canvas included 20+ custom designed Slider Pages with Premium Sliders like Layer, Revolution, Swiper &amp; others.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-6 col-lg-4">--}}
{{--                    <div class="feature-box fbox-border fbox-effect">--}}
{{--                        <div class="fbox-icon">--}}
{{--                            <a href="#"><i class="icon-tint i-alt"></i></a>--}}
{{--                        </div>--}}
{{--                        <div class="fbox-content">--}}
{{--                            <h3>Unlimited Color Options</h3>--}}
{{--                            <p>Change the color scheme of the Theme in a flash just by changing the 6-digit HEX code in the colors.php file.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-6 col-lg-4">--}}
{{--                    <div class="feature-box fbox-border fbox-effect">--}}
{{--                        <div class="fbox-icon">--}}
{{--                            <a href="#"><i class="icon-text-width i-alt"></i></a>--}}
{{--                        </div>--}}
{{--                        <div class="fbox-content">--}}
{{--                            <h3>CUSTOMIZABLE FONTS</h3>--}}
{{--                            <p>Use any Font you like from Google Web Fonts, Typekit or other Web Fonts. They will blend in perfectly.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        <div class="promo topmargin-lg promo-border bottommargin-lg promo-full p-5">--}}
{{--            <div class="container clearfix">--}}
{{--                <div class="row align-items-center">--}}
{{--                    <div class="col-12 col-lg">--}}
{{--                        <h3>Try Premium Free for <span>30 Days</span> and you'll never regret it!</h3>--}}
{{--                        <span>Starts at just <em>$0/month</em> afterwards. No Ads, No Gimmicks and No SPAM. Just Real Content.</span>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-lg-auto mt-4 mt-lg-0">--}}
{{--                        <a href="#" class="button button-large button-circle m-0">Start Trial</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="container clearfix">

            <div id="side-navigation" class="row col-mb-50" data-plugin="tabs">

                <div class="col-md-6 col-lg-4">
                    <ul class="sidenav">
                        <li class="ui-tabs-active"><a href="#snav-content1"><i class="icon-screen"></i>Kelitbangan<i class="icon-chevron-right"></i></a></li>
                        <li><a href="#snav-content2"><i class="icon-magic"></i>Penelitian Daerah<i class="icon-chevron-right"></i></a></li>
                        <li><a href="#snav-content3"><i class="icon-double-angle-up"></i>Pengembangan Daerah<i class="icon-chevron-right"></i></a></li>
                        <li><a href="#snav-content4"><i class="icon-lightbulb"></i>Inovasi Daerah<i class="icon-chevron-right"></i></a></li>
{{--                        <li><a href="#snav-content5"><i class="icon-adjust"></i>Light &amp; Dark Scheme<i class="icon-chevron-right"></i></a></li>--}}
                    </ul>
                </div>

                <div class="col-md-6 col-lg-8">
                    <div id="snav-content1">
                        <div class="heading-block">
                            <h3>Kelitbangan</h3>
{{--                            <span>We support multiple Devices &amp; Layouts.</span>--}}
                        </div>
{{--                        <img src="images/others/mac-phone.png" alt="Image" class="alignleft" style="max-width: 320px;">--}}
                        <p>Kelitbangan adalah rangkaian kegiatan ilmiah yang bertujuan menghasilkan pemahaman baru dan mengembangkan penerapan praktis nilai dan konteks ilmu pengetahuan yang baru, atau cara baru dalam rangka penyelenggaraan pemerintahan dalam negeri di lingkungan Kementerian Dalam Negeri (Kemendagri) dan pemerintahan daerah. Didalam kegiatan kelitbangan terdapat beberapa tahapan pengkajian yang meliputi Penelitian daerah, Pengembangan daerah dan Inovasi daerah.</p>
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur tempora perferendis maiores saepe voluptatibus possimus, voluptatum laborum. Veritatis deleniti expedita veniam quo eum commodi laboriosam illo obcaecati sit in, illum saepe neque voluptas quis, ullam porro autem. Qui incidunt amet eum dolores expedita, sit laudantium, saepe. Nam tempore rerum, quibusdam est quia impedit rem unde nostrum voluptatum minus ipsa quam fugiat ullam voluptatibus neque accusamus modi eos veniam. Dolor, reiciendis.</p>--}}
                    </div>

                    <div id="snav-content2">
                        <div class="heading-block">
                            <h3>Penelitian Daerah</h3>
{{--                            <span>Crisp &amp; Clear Graphics across all your Retina &amp; Standard Devices.</span>--}}
                        </div>
                        <p>Penelitian adalah kegiatan yang dilakukan menurut kaidah dan metode ilmiah secara sistematis untuk memperoleh informasi, data, dan keterangan yang berkaitan dengan pemahaman dan pembuktian kebenaran atau ketidakbenaran suatu asumsi dan/atau hipotesis di bidang ilmu pengetahuan dan teknologi terkait dengan penyelenggaraan pemerintahan dalam negeri dan menarik kesimpulan ilmiah bagi keperluan kemajuan kebijakan pemerintahan.</p>
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum consequuntur quaerat vero qui ipsum sunt velit vel, officia, nihil amet ullam. Omnis nam rerum, harum!</p>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima perspiciatis cumque, ipsa laudantium totam blanditiis, expedita ut odit, cupiditate rem facilis ea ab, hic amet numquam nulla possimus consectetur ipsum fuga! Atque quibusdam, id eius illum numquam porro architecto accusamus nam adipisci mollitia excepturi dolores non, maiores sit fuga vero cumque ullam. Vitae quidem totam similique tempore eligendi necessitatibus culpa.</p>--}}
                    </div>

                    <div id="snav-content3">
                        <div class="heading-block">
                            <h3>Pengembangan Daerah</h3>
{{--                            <span>Smart Reusable code all throughout the Template for Infinite Customizations.</span>--}}
                        </div>
                        <p>Pengembangan adalah kegiatan ilmu pengetahuan dan teknologi yang bertujuan memanfaatkan kaidah dan teori ilmu pengetahuan yang terbukti kebenarannya untuk meningkatkan fungsi, manfaat, dan aplikasi ilmu pengetahuan yang telah ada, atau menghasilkan teknologi baru yang terkait dengan penyelenggaraan pemerintahan dalam negeri.</p>
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla, optio animi adipisci distinctio fuga, nihil perferendis dignissimos. Aperiam odio voluptatem dignissimos aliquam? Ea, nihil animi, recusandae quos nulla, suscipit magni provident nesciunt incidunt quo dicta asperiores iste. Illo, qui culpa. Reprehenderit in asperiores blanditiis pariatur aliquid iusto. Quisquam voluptatibus nostrum architecto repudiandae voluptate, ipsum quae iure! Commodi recusandae, repellendus voluptas fugiat aspernatur culpa quod delectus quidem consequatur odio assumenda saepe inventore molestiae ea expedita hic dolorum distinctio ut! Maiores, error.</p>--}}
                    </div>

                    <div id="snav-content4">
                        <div class="heading-block">
                            <h3>Inovasi Daerah</h3>
{{--                            <span>Use the amazing features of the Bootstrap Framework.</span>--}}
                        </div>
                        <p>Inovasi Daerah adalah semua bentuk pembaharuan dalam penyelenggaraan Pemerintahan Daerah yang bertujuan untuk meningkatkan kinerja penyelenggaraan Pemerintahan Daerah dengan sasaran untuk mempercepat terwujudnya kesejahteraan masyarakat melalui: peningkatan Pelayanan Publik; pemberdayaan dan peran serta masyarakat; dan peningkatan daya saing Daerah.</p>
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum esse odio, voluptatem, fuga dolore labore. Voluptate, tenetur. Ab temporibus sed adipisci dolor ipsa cumque iusto maiores dolorum molestias magni expedita pariatur modi facere cupiditate eius quas, officiis eligendi cum veritatis dolore autem? Inventore vero doloremque sunt, et modi eos placeat.</p>--}}
                    </div>

{{--                    <div id="snav-content5">--}}
{{--                        <div class="heading-block">--}}
{{--                            <h3>Light &amp; Dark Schemes</h3>--}}
{{--                            <span>Use the dual tone schemes or mix them according to your needs.</span>--}}
{{--                        </div>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium voluptas eveniet, recusandae ducimus commodi, maiores voluptatem consequuntur autem quod id molestiae quam nulla minus aliquam nobis laboriosam nisi ut aut adipisci esse omnis at. Voluptatem, natus distinctio minus possimus, aliquid magnam ratione. Adipisci odit nemo voluptatum quas animi, amet et fuga quisquam possimus, dolore id sint eum consequuntur, magnam aliquid impedit doloremque voluptates, ducimus laboriosam. Sint quisquam molestias libero voluptatum.</p>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur nisi nemo et esse. Fugiat facere harum, error iusto assumenda illo debitis quas, fugit similique minima.</p>--}}
{{--                    </div>--}}
                </div>

            </div>

            <div class="line"></div>

{{--            <h4 class="center">Meet our Clients</h4>--}}

{{--            <ul class="clients-grid grid-2 grid-sm-3 grid-md-6 mb-0">--}}
{{--                <li class="grid-item"><a href="http://logofury.com/logo/enzo.html"><img src="images/clients/1.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com"><img src="images/clients/2.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofaves.com/2021/03/grabbt/"><img src="images/clients/3.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofaves.com/2021/01/ladera-granola/"><img src="images/clients/4.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofaves.com/2021/02/hershel-farms/"><img src="images/clients/5.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com/logo/food-fight-radio.html"><img src="images/clients/6.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com"><img src="images/clients/7.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com/logo/up-travel.html"><img src="images/clients/8.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com/logo/caffi-bardi.html"><img src="images/clients/9.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com/logo/bignix-design.html"><img src="images/clients/10.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com/"><img src="images/clients/11.png" alt="Clients"></a></li>--}}
{{--                <li class="grid-item"><a href="http://logofury.com/"><img src="images/clients/12.png" alt="Clients"></a></li>--}}
{{--            </ul>--}}

        </div>

{{--        <a href="#" class="button button-full center text-end footer-stick">--}}
{{--            <div class="container clearfix">--}}
{{--                Canvas comes with Unlimited Customizations &amp; Options. <strong>Check Out</strong> <i class="icon-caret-right" style="top:4px;"></i>--}}
{{--            </div>--}}
{{--        </a>--}}

    </div>
@endsection
