
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
                'link' : '/profile-definisi',
                'child': [],
            },
            {
                'nama' : 'Selayang Pandang',
                'link' : '/profile-selayang-pandang',
                'child': [],
            },
            // {
            //     'nama' : 'Struktur Organisasi',
            //     'link' : '#'
            // },

        ]

    },
    {
        'nama' : 'Informasi',
        'link' : '#',
        'subs' : [
            {
                'nama' : 'Informasi Publik',
                'link' : '#',
                'child' : [
                    {
                        'nama' : 'Informasi Berkala',
                        'link' : 'informasi/Informasi Berkala'
                    },
                    {
                        'nama' : 'Informasi Serta Meta',
                        'link' : 'informasi/Informasi Serta Merta'
                    },
                    {
                        'nama' : 'Informasi Tersedia Setiap Saat',
                        'link' : 'informasi/Tersedia Setiap Saat'
                    }

                ],
            },
            {
                'nama' : 'Regulasi',
                'link' : '/informasi-regulasi',
                'child' : [],
            },
            // {
            //     'nama' : 'SOP Kelitbangan',
            //     'link' : '#'
            // },
            // {
            //     'nama' : 'Rinduk Kota',
            //     'link' : '#'
            // },

            {
                'nama' : 'Agenda Kegiatan',
                'link' : '/informasi-agenda-kegiatan',
                'child' : [],
            },
            {
                'nama' : 'Berita & Artikel',
                'link' : '/informasi-berita-artikel',
                'child' : [],
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
                'link' : '/galeri-foto',
                'child': [],
            },
            {
                'nama' : 'Video',
                'link' : '/galeri-video',
                'child': [],
            },
        ]
    },
    {
        'nama' : 'Forum Komunikasi',
        'link' : '#',
        'subs' : [
            {
                'nama' : 'Penelitian',
                'link' : '/forum-penelitian',
                'child': [],
            },
            {
                'nama' : 'Inovasi',
                'link' : '/forum-incubator',
                'child': [],
            },
            {
                'nama' : 'Survey',
                'link' : '/forum-survey',
                'child': [],
            },
            {
                'nama' : 'Surat Rekomendasi',
                'link' : '/forum-rekomendasi',
                'child': [],
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
                console.log(subs)
                if(subs.child.length > 0){
                    listMenus += `<li class="menu-item">
                    <a class="menu-link" href="${subs.link}">
                        <div>${subs.nama}</div>
                    </a>`
                    listMenus += `<ul class="sub-menu-container">`;
                    $.each(subs.child, function (id3, child) {
                        listMenus +=  `<li class="menu-item">
                            <a class="menu-link" href="/${child.link}"><div>${child.nama}</div></a>
                        </li>`
                    });

                    listMenus += `</ul>`
                    listMenus +=`</li>`;
                }
                else{
                    listMenus += `<li class="menu-item">
                    <a class="menu-link" href="${subs.link}">
                        <div>${subs.nama}</div>
                    </a>
                </li>`
                }

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



function loadInovasi(data){
    let listGallery = ``;
    let cats = [];
    let clCat = '';
    $.each(data, function (id, value) {
        let src_img = '';
        if (value['attachment'].length > 0){
            src_img = `/images/upload/${value['attachment'][0]['nama']}`;
        }else{
            src_img = "images/extras/200x200.gif";
        }
        listGallery +=`<div class="entry col-md-3">
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




