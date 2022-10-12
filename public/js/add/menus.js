
var menus = [
    {
        'nama' : 'Beranda',
        'link' : '/',
        'subs' : [],
    },
    {
        'nama' : 'Profil',
        'link' : '#',
        'subs' : [
            {
                'nama' : 'Definisi',
                'link' : '/profile-definisi'
            },
            {
                'nama' : 'Selayang Pandang',
                'link' : '/profile-selayang-pandang'
            },
            {
                'nama' : 'Struktur Organisasi',
                'link' : '#'
            },

        ]

    },
    {
        'nama' : 'Informasi',
        'link' : '#',
        'subs' : [
            {
                'nama' : 'Regulasi',
                'link' : '/informasi-regulasi'
            },
            {
                'nama' : 'SOP Kelitbangan',
                'link' : '#'
            },
            // {
            //     'nama' : 'Rinduk Kota',
            //     'link' : '#'
            // },
            {
                'nama' : 'Agenda Kegiatan',
                'link' : '/informasi-agenda-kegiatan'
            },
            {
                'nama' : 'Berita & Artikel',
                'link' : '/informasi-berita-artikel'
            },

        ]
    },
    {
        'nama' : 'Kelitbangan',
        'link' : '/kelitbangan',
        'subs' : [

        ]
    },
    {
        'nama' : 'Inovasi',
        'link' : '/inovasi',
        'subs' : []
    },
    {
        'nama' : 'Galeri',
        'link' : '#',
        'subs' : [
            {
                'nama' : 'Foto',
                'link' : '/galeri-foto'
            },
            {
                'nama' : 'Video',
                'link' : '/galeri-video'
            },
        ]
    },
    {
        'nama' : 'Forum Komunikasi',
        'link' : '#',
        'subs' : [
            {
                'nama' : 'Penelitian',
                'link' : '/forum-penelitian'
            },
            {
                'nama' : 'Inovasi',
                'link' : '/forum-inovasi'
            },
            {
                'nama' : 'Survey',
                'link' : '/forum-survey'
            },
            {
                'nama' : 'Surat Rekomendasi',
                'link' : '/forum-rekomendasi'
            },
        ]
    }
];

var agenda = [
    {
        'judul' : 'Artikel 1',
        'tanggal' : '12 02 2022',
        'deskripsi' : 'Ini adalah Deskripsi Artikel 1',
        'gambar' :'',
    },
    {
        'judul' : 'Berita 1',
        'tanggal' : '12 03 2022',
        'deskripsi' : 'Ini adalah Deskripsi Berita 1',
        'gambar' :'',
    },
    {
        'judul' : 'Artikel 2',
        'tanggal' : '12 04 2022',
        'deskripsi' : 'Ini adalah Deskripsi Artikel 2',
        'gambar' :'',
    },
    {
        'judul' : 'Berita 2',
        'tanggal' : '12 05 2022',
        'deskripsi' : 'Ini Penjelasan Berita 2',
        'gambar' :'',
    },
];

var berita = [
    {
        'judul' : 'Judul Artikel 1',
        'tanggal' : '12 02 2022',
        'deskripsi' : 'Ini adalah Deskripsi Artikel 1',
        'gambar' :'',
        'oleh' :'Saya Sendiri',
        'Kategori' :'tidak,ada',
    },
    {
        'judul' : 'Judul Artikel 2',
        'tanggal' : '12 03 2022',
        'deskripsi' : 'Ini adalah Deskripsi Artikel 1',
        'gambar' :'',
        'oleh' :'Orang Lain',
        'Kategori' :'tidak,ada',
    },

];

var kajian = [
    {
        'judul'     : 'KAJIAN STRATEGIS SOSIAL ( PEMETAAN POPULASI KUNCI AIDS )',
        'deskripsi' : 'Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa',
        'link'      : '#',
    },
    {
        'judul'     : 'WHY CHOOSE US',
        'deskripsi' : 'Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa',
        'link'      : '#',
    },
    {
        'judul'     : 'PENGEMBANGAN PUSAT DATA TERINTEGRASI DI KOTA BANDUNG',
        'deskripsi' : 'Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa',
        'link'      : '#',
    },
    {
        'judul'     : 'STRATEGI PENANGANAN STUNTING KOTA BANDUNG (PENELITIAN MANDIRI)',
        'deskripsi' : 'Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa',
        'link'      : '#',
    },

];

var dok    = [
    {
        'tipe'    : 'foto',
        'judul'   : 'Open Imagination',
        'kategori': '',
        'detail'  : [],

    },
    {
        'tipe'    : 'foto',
        'judul'   : 'Locked Steel Gate',
        'kategori': '',
        'detail'  : [],

    },
    {
        'tipe'    : 'video',
        'judul'   : 'Mac Sun Glasses',
        'kategori': 'Grapichs,UI Elements',
        'detail'  : [],

    },
    {
        'tipe'    : 'foto',
        'judul'   : 'Morning Dew',
        'kategori': 'Icons,Illustration',
        'detail'  : [],

    },
    {
        'tipe'    : 'foto',
        'judul'   : '',
        'kategori': '',
        'detail'  : [],

    },
    {
        'tipe'    : 'foto',
        'judul'   : '',
        'kategori': '',
        'detail'  : [],

    },
    {
        'tipe'    : 'foto',
        'judul'   : '',
        'kategori': '',
        'detail'  : [],

    },
    {
        'tipe'    : 'foto',
        'judul'   : '',
        'kategori': '',
        'detail'  : [],

    }

];

function loadMenu() {
    let listMenus = '';
    $.each(menus, function (id, value) {

        if(value.subs.length > 0){
            listMenus += `<li class="menu-item sub-menu">
                <a class="menu-link" href="${value.link}">
                    <div>${value.nama}</div>
                </a>`;
            listMenus += `<ul class="sub-menu-container"> `;
            $.each(value.subs, function (id2, subs) {
                listMenus += `<li class="menu-item">
                    <a class="menu-link" href="${subs.link}">
                        <div>${subs.nama}</div>
                    </a>
                </li>`
            });
            listMenus += `</ul>`;
        }else{
            listMenus += `<li class="menu-item">
                <a class="menu-link" href="${value.link}">
                    <div>${value.nama}</div>
                </a>`;
        }
        listMenus += `</li>`;
    });

    $(`.menu-container`).append(listMenus);
}

function loadAgenda() {
    let listAgenda = '';
    $.each(agenda, function (id, value) {
        listAgenda += `
        <div class="entry col-lg-6 col-12">
            <div class="entry-timeline">
                <div class="timeline-divider"></div>
            </div>
            <div class="grid-inner">
                <div class="entry-image">
                    <a href="${value.gambar}" data-lightbox="image">
                    <img src="images/blog/small/17.jpg"alt="${value.judul}">
                    </a>
                </div>
                <div class="entry-title">
                    <h2><a href="#">${value.judul}</a></h2>
                </div>
                <div class="entry-meta">
                    <ul>
                        <li><i class="icon-calendar3"></i> ${value.tanggal}</li>
                        <li><a href="blog-single.html#comments"><i class="icon-comments"></i> -</a></li>
                        <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                    </ul>
                </div>
                <div class="entry-content">
                    <p>${value.deskripsi}.</p>
                    <a href="#" class="more-link">Read More</a>
                </div>
            </div>
        </div>`;
    });

    $('#posts_agenda').append(listAgenda);

}

function loadBerita() {
    let listAgenda = '';
    $.each(berita, function (id, value) {
        listAgenda += `<div class="entry col-12">
                            <div class="grid-inner row g-0">
                                <div class="col-md-4">
                                    <a class="entry-image" href="#" data-lightbox="image"><img src="#" alt="Standard Post with Image"></a>
                                </div>
                                <div class="col-md-8 ps-md-4">
                                    <div class="entry-title title-sm">
                                        <h2><a href="blog-single.html">${value.judul}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i> ${value.tanggal}</li>
                                            <li><a href="#"><i class="icon-user"></i> ${value.oleh}</a></li>
                                            <li><i class="icon-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li>
                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="entry-content">
                                        <p>${value.deskripsi}</p>
                                        <a href="blog-single.html" class="more-link">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;

    });
    $('#posts_berita').html('');
    $('#posts_berita').append(listAgenda);

}

function loadKajian(list) {
    let listKajian = '';
    let delai = 0;
    $.each(list, function (id, value) {
    listKajian += `<div class="col-sm-6 col-lg-3 text-center" data-delay="${delai}" >
        <div>
            <h5 class="text-uppercase" style="font-weight: 200;">${value.judul}</h5>
            <p style="line-height: 1.8; text-align: left;">${value.abstrak.toString().substr(0,150)} ...</p>
            <a href="/view-kelitbangan/${value.id}" class="button button-border button-black button-rounded text-uppercase m-0">Read More</a>
        </div>
    </div>`;
    delai += 200;
    });

    $('#post_kajian').append(listKajian);
}

function loadGallery(){
    let listGallery = ``;
    let cats = [];
    let clCat = '';
    $.each(dok, function (id, value) {
        cats = value.kategori.split(',');
        $.each(cats, function (k, c) {
            clCat += 'pf-'+c+' ';
        })
        listGallery +=`<article class="portfolio-item col-6 col-md-4 col-lg-3 ${clCat}">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="${value.link}">
                        <img src="{{ asset('images/portfolio/${value.id}/') }}4/4.jpg" alt="Open Imagination">
                    </a>
                    <div class="bg-overlay" data-lightbox="gallery">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="images/portfolio/full/4.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                            <a href="images/portfolio/full/4-1.jpg" class="d-none" data-lightbox="gallery-item"></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single-gallery.html">Morning Dew</a></h3>
                    <span><a href="#">Icons</a>, <a href="#">Illustrations</a></span>
                </div>
            </div>
        </article>`;
    });

}

function loadInovasi(data){
    let listGallery = ``;
    let cats = [];
    let clCat = '';
    $.each(data, function (id, value) {
        let src_img = '';
        if (value['attachment'].length > 0){
            src_img = `/images/upload/${value['attachment'][0]['nama']}`;
        }else{
            src_img = "images/magazine/thumb/11.jpg";
        }
        listGallery +=`<div class="entry col-md-4">
                        <div class="grid-inner">
                            <div class="entry-image">
                                <a href="javascript:;">

                                <img src="${src_img}" alt="Image" style="width:100%; height: 200px;">
                                </a>
                            </div>
                            <div class="entry-title title-sm nott">
                                <h3><a href="/view-inovasi/${value.id}">${value.nama}</a></h3>
                            </div>
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="icon-building2"></i> ${value.instansi_data['nama']}</li>
                                    <li><a href="blog-single.html#comments"><i class="icon-calendar"></i> ${value.tanggal}</a></li>
                                </ul>
                            </div>
                            <div class="entry-content">
                                <p>${value.deskripsi.toString().substr(0,100)}</p>
                            </div>
                        </div>
                    </div>`;
    });
    $('#post_inovasi').html('');
    $('#post_inovasi').append(listGallery);


}




