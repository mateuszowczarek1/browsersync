<script setup>
import { useAuthStore } from '../store/userStore';
import Layout from './Layout.vue';
import Panel from './components/Panel.vue';
const auth = useAuthStore();
auth.clearUser();
</script>

<template>
    <Layout>
        <Panel title="Hello!" class="col-span-2" id="hero">
            <div class="flex gap-8 p-2 items-center justify-center flex-col">

                <div class="text-xl text-justify space-y-5 break-words">
                    <h1 class="text-4xl">Bookmarkr - Organize your bookmarks!</h1>
                    <p>Introducing our sleek bookmark management platform! Our app provides a streamlined solution for
                        organizing and managing all your bookmarks one convenient location. Bid farewell to cluttered
                        browse bookmarks and embrace seamless organization!
                    </p>
                    <p>Our platform simplifies the process of adding and categorizing bookmarks with just a few clicks.
                        Whether you're saving articles, websites, or resources for later, our intuitive interface allows
                        you to create a tailored system tailored to your preferences. Plus, each bookmark can be
                        assigned multiple categories, ensuring easy access and efficient organization.
                    </p>
                    <p>
                        But that's not all – we elevate bookmark management with the introduction of catalogues. These
                        customizable
                        collections enable you to curate and group related bookmarks together, facilitating effortless
                        retrieval of
                        information. Additionally, our sharing feature empowers you to collaborate with friends,
                        colleagues, or
                        classmates by effortlessly sharing your catalogues with them.
                    </p>
                    <p>
                        Ready to revolutionize your bookmark organization? Register for an account today and unlock the
                        full
                        potential of our platform. Say hello to seamless bookmark management and bid farewell to digital
                        clutter
                        – welcome to the future of bookmark organization!
                    </p>
                </div>
            </div>
        </Panel>
    </Layout>
</template>

<style scoped>
#hero {
    background-image: linear-gradient(rgba(20, 13, 54, 0.9), rgba(20, 13, 54, 0.9)),
        url("/resources/herobg.webp");
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}
</style>
