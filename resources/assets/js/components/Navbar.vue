<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <router-link class="navbar-brand" :to="{ name: 'dashboard' }"
                >Laravel Vue Admin</router-link
            >
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link
                            class="nav-link"
                            :to="{ name: 'dashboard' }"
                            >Anasayfa
                            <span class="sr-only">(current)</span></router-link
                        >
                    </li>

                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Kullanıcılar
                        </a>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdown"
                        >
                            <router-link
                                :to="{ name: 'users' }"
                                class="dropdown-item"
                                >Kullanıcı Listesi</router-link
                            >
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input
                        class="form-control mr-sm-2"
                        type="search"
                        placeholder="Search"
                        aria-label="Search"
                    />
                    <button
                        class="btn btn-outline-light my-2 my-sm-0"
                        type="submit"
                    >
                        Ara
                    </button>
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
export default {};
</script>

<style></style>
