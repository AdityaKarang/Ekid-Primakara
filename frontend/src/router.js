import Vue from "vue";
import Router from "vue-router";


Vue.use(Router);

const router = new Router({
  routes: [
    {
      path: "/lppm",
      component: () => import("@/view/lppm/layout/Layout"),
      meta: { requiresAuth: true, role: 'admin' },
      children: [
        {
          path: "dashboard",
          name: "admin-dashboard",
          component: () => import("@/view/lppm/Dashboard.vue"),
        },
        {
          path: "masterdata-user",
          name: "masterdata-user",
          component: () => import("@/view/lppm/pages/Masterdatauser.vue")
        },
        {
          path: "masterdata-bidangfokus",
          name: "masterdata-bidangfokus",
          component: () => import("@/view/lppm/pages/Masterdatabidangfokus.vue")
        },
        {
          path: "masterdata",
          name: "masterdata",
          component: () => import("@/view/lppm/pages/Masterdata.vue")
        },
        {
          path: "masterdata-publikasi",
          name: "masterdata-publikasi",
          component: () => import("@/view/lppm/pages/Masterdatapublikasi.vue")
        },
        {
          path: "masterdata-penilaian",
          name: "masterdata-penilaian",
          component: () => import("@/view/lppm/pages/Masterdatapenilaian.vue")
        },
        {
          path: "data-proposal",
          name: "data-proposal",
          component: () => import("@/view/lppm/pages/Dataproposal.vue")
        },
        {
          path: "manage-reviewer",
          name: "manage-reviewer",
          component: () => import("@/view/lppm/pages/Managereviewer.vue")
        },
        {
          path: "input-penelitian",
          name: "input-peneilaian",
          component: () => import("@/view/lppm/pages/InputPenelitian.vue")
        },
        {
          path: "input-pengabdian",
          name: "input-pengabdian",
          component: () => import("@/view/lppm/pages/InputPengabdian.vue")
        },
        {
          path: "laporan/penelitian",
          name: "laporan-penelitian-lppm",
          component: () => import("@/view/lppm/pages/LaporanPenelitian.vue")
        },
        {
          path: "laporan/pengabdian",
          name: "laporan-pengabdian-lppm",
          component: () => import("@/view/lppm/pages/LaporanPengabdian.vue")
        },
        {
          path: "rekapitulasi",
          name: "rekapitulasi",
          component: () => import("@/view/lppm/pages/rekapitulasi/rekapitulasi.vue")
        },
        {
          path: "rekapitulasi/proposal/penelitian/detail",
          name: "rekapitulasi-proposal-penelitian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/proposal/DetailRekapitulasiProposalPenelitian.vue")

        },
        {
          path: "rekapitulasi/proposal/pengabdian/detail",
          name: "rekapitulasi-proposal-pengabdian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/proposal/DetailRekapitulasiProposalPengabdian.vue")

        },
        {
          path: "rekapitulasi/kemajuan/penelitian/detail",
          name: "rekapitulasi-kemajuan-penelitian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/kemajuan/DetailRekapitulasiKemajuanPenelitian.vue")

        },
        {
          path: "rekapitulasi/kemajuan/pengabdian/detail",
          name: "rekapitulasi-kemajuan-pengabdian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/kemajuan/DetailRekapitulasiKemajuanPengabdian.vue")

        },
        {
          path: "rekapitulasi/akhir/penelitian/detail",
          name: "rekapitulasi-akhir-penelitian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/akhir/DetailRekapitulasiAkhirPenelitian.vue")

        },
        {
          path: "rekapitulasi/akhir/pengabdian/detail",
          name: "rekapitulasi-akhir-pengabdian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/akhir/DetailRekapitulasiAkhirPengabdian.vue")

        },
        {
          path: "rekapitulasi/publikasi/penelitian/detail",
          name: "rekapitulasi-publikasi-penelitian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/publikasi/DetailRekapitulasiPublikasiPenelitian.vue")

        },
        {
          path: "rekapitulasi/publikasi/pengabdian/detail",
          name: "rekapitulasi-publikasi-pengabdian-detail",
          component: () => import("@/view/lppm/pages/rekapitulasi/publikasi/DetailRekapitulasiPublikasiPengabdian.vue")

        },
        {
          path: "ekid",
          name: "ekid",
          component: () => import("@/view/lppm/pages/ekid/EKID.vue")
        },
        {
          path: "detail/proposal",
          name: "detail-proposal",
          component: () => import("@/view/lppm/pages/Detailproposal.vue")

        },
        {
          path: "penjadwalan",
          name: "penjadwalan",
          component: () => import("@/view/lppm/pages/penjadwalan/penjadwalan.vue")
        },
        {
          path: "laporan-kemajuan",
          name: "laporankemajuan",
          component: () => import("@/view/lppm/pages/LaporanKemajuan/LaporanKemajuan.vue")
        },
        {
          path: "laporan-akhir",
          name: "laporanakhir",
          component: () => import("@/view/lppm/pages/LaporanAkhir/LaporanAkhir.vue")
        },
        {
          path: "monev",
          name: "monev",
          component: () => import("@/view/lppm/pages/LaporanMonev/LaporanMonev.vue")
        },
        {
          path: "edit/data/laporan",
          name: "edit-data-laporan",
          component: () => import("@/view/lppm/pages/edit/EditDataLaporan.vue")
        },
        {
          path: "edit/data/laporan/detail",
          name: "edit-data-laporan-detail",
          component: () => import("@/view/lppm/pages/edit/DetailEditDataLaporan.vue")
        }
      ]
    },
    // {


    //   path: "/dosen",
    //   component: () => import("@/view/dosen/layout/Layout"),
    //   meta: { requiresAuth: true, role: 'dosen' },
    //   children: [
    //     {
    //       path: "dashboard",
    //       name: "dosen-dashboard",
    //       component: () => import("@/view/dosen/Dashboard.vue")
    //     },
    //     {
    //       path: "penelitian",
    //       name: "peneilaian",
    //       component: () => import("@/view/dosen/pages/Penelitian.vue"),
    //     },
    //     {
    //       path: "pengabdian",
    //       name: "pengabdian",
    //       component: () => import("@/view/dosen/pages/Pengabdian.vue"),
    //     },
    //     {
    //       path: "detail-penelitian",
    //       name: "detail-penelitian",
    //       component: () => import("@/view/dosen/pages/DetailPenelitian.vue")
    //     },
    //     {
    //       path: "detail-pengabdian",
    //       name: "detail-pengabdian",
    //       component: () => import("@/view/dosen/pages/DetailPengabdian.vue")
    //     },

    //     // {
    //     //   path: "laporan/penelitian",
    //     //   name: "laporan-penelitian",
    //     //   component: () => import("@/view/dosen/pages/Laporanpenelitian.vue")
    //     // },
    //     {
    //       path: "detail/laporan",
    //       name: "detail-laporan",
    //       component: () => import("@/view/dosen/pages/DetailLaporan.vue")
    //     },
    //     {
    //       path: "laporan/pengabdian",
    //       name: "laporan-pengabdian",
    //       component: () => import("@/view/dosen/pages/Laporanpengabdian.vue")
    //     },
    //     {
    //       path: "detail/laporan/pengabdian",
    //       name: "detail-laporan-pengabdian",
    //       component: () => import("@/view/dosen/pages/DetailLaporanPengabdian.vue")
    //     },
    //     {
    //       path: "laporan/penelitian",
    //       name: "laporan-penelitian",
    //       component: () => import("@/view/dosen/pages/Laporanpenelitian.vue")
    //     },
    //     {
    //       path: "penunjang",
    //       name: "penunjang",
    //       component: () => import("@/view/dosen/pages/Penunjang.vue")
    //     },
    //     {
    //       path: "reviewer/review",
    //       name: "review",
    //       component: () => import("@/view/dosen/pages/Reviewer/Review.vue")
    //     },
    //     {
    //       path: "reviewer/review/detail",
    //       name: "detail-review",
    //       component: () => import("@/view/dosen/pages/Reviewer/DetailReview.vue")
    //     }

    //     // {
    //     //   path: "transkip/penunjang",
    //     //   name: "transkip-penunjang",
    //     //   component: () => import("@/view/dosen/pages/Laporanpenunjang.vue")
    //     // },
    //   ]
    // },

    {
      path: "/dosen",
      component: () => import("@/view/dosen/layout/Layout"),
      meta: { requiresAuth: true, role: 'dosen' },
      children: [
        {
          path: "dashboard",
          name: "dosen-dashboard",
          component: () => import("@/view/dosen/Dashboard.vue"),
        },
        {
          path: "penelitian",
          name: "peneilaian",
          component: () => import("@/view/dosen/pages/Penelitian.vue"),
        },
        {
          path: "pengabdian",
          name: "pengabdian",
          component: () => import("@/view/dosen/pages/Pengabdian.vue"),
        },
        {
          path: "detail/penelitian",
          name: "dosen-detail-penelitian",
          component: () => import("@/view/dosen/pages/DetailPenelitian.vue")
        },
        {
          path: "detail-pengabdian",
          name: "detail-pengabdian",
          component: () => import("@/view/dosen/pages/DetailPengabdian.vue")
        },

        {
          path: "laporan/penelitian",
          name: "laporan-penelitian",
          component: () => import("@/view/dosen/pages/Laporanpenelitian.vue")
        },
        {
          path: "detail/laporan",
          name: "detail-laporan",
          component: () => import("@/view/dosen/pages/DetailLaporan.vue")
        },
        {
          path: "laporan/pengabdian",
          name: "laporan-pengabdian",
          component: () => import("@/view/dosen/pages/Laporanpengabdian.vue")
        },
        {
          path: "detail/laporan/pengabdian",
          name: "detail-laporan-pengabdian",
          component: () => import("@/view/dosen/pages/DetailLaporanPengabdian.vue")
        },
        // {
        //   path: "laporan/penelitian",
        //   name: "laporan-penelitian",
        //   component: () => import("@/view/dosen/pages/Laporanpenelitian.vue")
        // },
        {
          path: "penunjang",
          name: "penunjang-dosen",
          component: () => import("@/view/dosen/pages/Penunjang.vue")
        },
        // {
        //   path: "dosen/review",
        //   name: "review",
        //   component: () => import("@/view/dosen/pages/Reviewer/Review.vue")
        // },
        // {
        //   path: "reviewer/review/detail",
        //   name: "detail-penilaian",
        //   component: () => import("@/view/reviewer/pages/Reviewer/DetailReview.vue")
        // }

        // {
        //   path: "transkip/penunjang",
        //   name: "transkip-penunjang",
        //   component: () => import("@/view/dosen/pages/Laporanpenunjang.vue")
        // },
      ]
    },

    {
      path: "/reviewer",
      component: () => import("@/view/reviewer/layout/Layout"),
      meta: { requiresAuth: true, role: 'reviewer' },
      children: [
        {
          path: "dashboard",
          name: "reviewer-dashboard",
          component: () => import("@/view/reviewer/Dashboard.vue")
        },
        {
          path: "review",
          name: "review",
          component: () => import("@/view/reviewer/pages/Reviewer/Review.vue")
        },
        {
          path: "review/penelitian",
          name: "review-penelitian",
          component: () => import("@/view/reviewer/pages/Proposal/DetailReviewPenelitian.vue")
        },
        {
          path: "review/pengabdian",
          name: "review-pengabdian",
          component: () => import("@/view/reviewer/pages/Proposal/DetailReviewPengabdian.vue")
        },
        {
          path: "review/penelitian/laporankemajuan",
          name: "review-penelitian-laporankemajuan",
          component: () => import("@/view/reviewer/pages/Kemajuan/DetailReviewKemajuanPenelitian.vue")
        },
        {
          path: "review/pengabdian/laporankemajuan",
          name: "review-pengabdian-laporankemajuan",
          component: () => import("@/view/reviewer/pages/Kemajuan/DetailReviewKemajuanPengabdian.vue")
        },
        {
          path: "review/penelitian/laporanakhir",
          name: "review-penelitian-laporanakhir",
          component: () => import("@/view/reviewer/pages/Akhir/DetailReviewAkhirPenelitian.vue")
        },
        {
          path: "review/pengabdian/laporanakhir",
          name: "review-pengabdian-laporanakhir",
          component: () => import("@/view/reviewer/pages/Akhir/DetailReviewAkhirPengabdian.vue")
        }

        // {
        //   path: "transkip/penunjang",
        //   name: "transkip-penunjang",
        //   component: () => import("@/view/dosen/pages/Laporanpenunjang.vue")
        // },
      ]
    },
    {


      path: "/hrd",
      component: () => import("@/view/hrd/layout/Layout"),
      meta: { requiresAuth: true, role: 'hrd' },
      children: [
        {
          path: "dashboard",
          name: "hrd-dashboard",
          component: () => import("@/view/hrd/Dashboard.vue")
        },
        {
          path: "penunjang",
          name: "penunjang",
          component: () => import("@/view/hrd/penunjang/dataPenunjang.vue")

        },
        {
          path: "laporan/penunjang",
          name: "laporan-penunjang",
          component: () => import("@/view/hrd/LaporanPenunjang/LaporanPenunjang.vue")

        }
        ,
        // {
        //   path: "laporan/penunjang/detail",
        //   name: "laporan-penunjang-detail",
        //   component: () => import("@/view/hrd/LaporanPenunjang/detail/DetailLaporanPenunjang.vue")

        // },
        {
          path: "laporan/penunjang/detail",
          name: "laporan-penunjang-detail",
          component: () => import("@/view/hrd/LaporanPenunjang/DetailLaporanPenunjang.vue")


        },
        {
          path: "master/penunjang",
          name: "master-penunjang",
          component: () => import("@/view/hrd/master/MasterPenunjang.vue")

        }

      ]
    },
    {


      path: "/kaprodi",
      component: () => import("@/view/kaprodi/layout/Layout"),
      meta: { requiresAuth: true, role: 'kaprodi' },
      children: [
        {
          path: "dashboard",
          name: "kaprodi-dashboard",
          component: () => import("@/view/kaprodi/Dashboard.vue")
        },
        {
          path: "pendidikan",
          name: "kaprodi-pendidikan",
          component: () => import("@/view/kaprodi/pages/pendidikan/Pendidikan.vue"),
        },

        {
          path: "penelitian",
          name: "kaprodi-peneilaian",
          component: () => import("@/view/kaprodi/pages/penelitian/Penelitian.vue"),
        },

        {
          path: "penelitian/detail",
          name: "kaprodi-penelitian-detail",
          component: () => import("@/view/kaprodi/pages/penelitian/DetailPenelitian.vue"),
        },
        {
          path: "pengabdian",
          name: "kaprodi-pengabdian",
          component: () => import("@/view/kaprodi/pages/pengabdian/Pengabdian.vue"),
        },
        {
          path: "pengabdian/detail",
          name: "kaprodi-pengabdian-detail",
          component: () => import("@/view/kaprodi/pages/pengabdian/DetailPengabdian.vue"),
        },
        {
          path: "penunjang",
          name: "kaprodi-penunjang",
          component: () => import("@/view/kaprodi/pages/penunjang/Penunjang.vue")
        },
        {
          path: "penunjang/detail",
          name: "kaprodi-penunjang-detail",
          component: () => import("@/view/kaprodi/pages/penunjang/DetailPenunjang.vue")
        },
        {
          path: "rekapitulasi",
          name: "kaprodi-rekapitulasi",
          component: () => import("@/view/kaprodi/pages/rekapitulasi/Rekapitulasi.vue")
        },

      ]
    },

    {
      path: "/",
      name: "login",
      component: () => import("@/view/auth/login_pages/Login-1.vue"),
      meta: { public: true },
    },
  ],

});


router.beforeEach((to, from, next) => {
  const authRequired = !to.meta.public;
  const loggedIn = localStorage.getItem('user');

  // Trying to access a restricted page + not logged in
  // Redirect to login page or redirect to the landing page
  if (authRequired && !loggedIn) {
    next('/');
  } else {
    next();
  }
});

export default router;
