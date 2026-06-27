const { createApp } = Vue;
const { createRouter, createWebHashHistory } = VueRouter;

const apiUrl = 'http://localhost/lab7_php_ci/public';   // ← Ubah sesuai nama folder CI kamu

// ====================== AXIOS INTERCEPTORS (Praktikum 14) ======================
axios.interceptors.request.use(config => {
    const token = localStorage.getItem('userToken');
    if (token) config.headers.Authorization = 'Bearer ' + token;
    return config;
}, error => Promise.reject(error));

axios.interceptors.response.use(response => response, error => {
    if (error.response && error.response.status === 401) {
        alert('Sesi berakhir. Silakan login kembali.');
        localStorage.clear();
        window.location.href = '#/login';
    }
    return Promise.reject(error);
});

// ====================== ROUTES ======================
const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/artikel', component: Artikel, meta: { requiresAuth: true } },
    { path: '/about', component: About, meta: { requiresAuth: true } }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

// Navigation Guards
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('isLoggedIn') === 'true';
    if (to.meta.requiresAuth && !isAuthenticated) {
        alert('Akses Ditolak! Harus login terlebih dahulu.');
        next('/login');
    } else {
        next();
    }
});

// ====================== APP ======================
const app = createApp({
    data() {
        return { isLoggedIn: localStorage.getItem('isLoggedIn') === 'true' }
    },
    mounted() {
        this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    },
    methods: {
        logout() {
            if (confirm('Yakin ingin logout?')) {
                localStorage.clear();
                this.isLoggedIn = false;
                this.$router.push('/');
            }
        }
    }
});

app.use(router);
app.mount('#app');