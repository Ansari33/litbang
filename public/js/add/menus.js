
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
                'link' : '/profile/definisi'
            },
            {
                'nama' : 'Selayang Pandang',
                'link' : '/profile/selayang-pandang'
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
                'link' : '/informasi/regulasi'
            },
            {
                'nama' : 'SOP Kelitbangan',
                'link' : '#'
            },
            {
                'nama' : 'Rinduk Kota',
                'link' : '#'
            },
            {
                'nama' : 'Agenda Kegiatan',
                'link' : '/informasi/agenda-kegiatan'
            },
            {
                'nama' : 'Berita & Artikel',
                'link' : '/informasi/berita-artikel'
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
        'link' : '',
        'subs' : []
    },
    {
        'nama' : 'Galeri',
        'link' : '',
        'subs' : [
            {
                'nama' : 'Foto',
                'link' : '#'
            },
            {
                'nama' : 'Video',
                'link' : '#'
            },

        ]
    },
    {
        'nama' : 'Forum Komunikasi',
        'link' : '',
        'subs' : [
            {
                'nama' : 'Penelitian',
                'link' : '#'
            },
            {
                'nama' : 'Inovasi',
                'link' : '#'
            },

        ]
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
                    <img src="${value.gambar}"alt="${value.judul}">
                    </a>
                </div>
                <div class="entry-title">
                    <h2><a href="blog-single.html">${value.judul}</a></h2>
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
        </div>`
    });

    $('#posts_agenda').append(listAgenda);

}

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


