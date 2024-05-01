<script setup>
defineProps({ user: Object })
import Layout from './Layout.vue';
import PrimaryButton from './components/PrimaryButton.vue';
import SecondaryButton from './components/SecondaryButton.vue';
import TheBar from './components/TheBar.vue'
</script>

<template>
    <Layout>
        <section class="lg:max-w-[30%] p-2 text-justify md:w-[100%]">
            <h2 class="text-3xl">First section</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa molestiae maxime repellendus minima
                adipisci veniam dolor voluptate sint. Beatae nihil assumenda natus laborum perferendis aut quasi dolorem
                voluptatem eligendi id?
            </p>

        </section>
        <section class="lg:max-w-[30%] p-2 text-justify md:w-[100%]">
            <h2 class="text-3xl">Second section</h2>
            <div>
                <h2 class="block mt-4 font-bold text-3xl mb-2">{{ user.firstName }} is the besto</h2>
            </div>
            <div>
                <PrimaryButton button-name="Primary" />
                <SecondaryButton button-name="Secondary" />
            </div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates, id. Repellendus laboriosam neque dolorum distinctio illum id maiores nobis fugiat, tenetur earum enim porro cum facilis commodi totam optio perferendis?
            Itaque aliquam illo explicabo suscipit distinctio accusantium temporibus nisi praesentium voluptatum alias libero vitae quisquam impedit eligendi fugit recusandae atque, velit beatae enim commodi. Voluptatem dolores vel magni rerum a?
            Inventore doloremque alias aliquam illo deserunt dolorem, commodi aspernatur perferendis accusantium neque velit quidem! At possimus accusantium omnis, quam voluptate consectetur harum, iure eligendi explicabo temporibus mollitia, maiores odio repellat!</p>

        </section>


        <section class="lg:max-w-[30%] p-2 text-justify md:w-[100%]">
            <h2 class="text-3xl">Third section</h2>
            <p>
            <h2>Should be working now</h2>
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui harum eligendi quibusdam maxime quos omnis perspiciatis nesciunt. Similique voluptatem consequuntur ducimus veritatis praesentium cupiditate eos accusamus, ut quis at rerum.
                Molestiae, necessitatibus laborum aliquid quam modi dolorem esse assumenda ullam quisquam. Veniam harum saepe odit obcaecati, deserunt voluptate corporis, esse nostrum consectetur, nobis vitae quae fuga odio possimus reprehenderit repellat!
            </p>
        </section>
    </Layout>
</template>
