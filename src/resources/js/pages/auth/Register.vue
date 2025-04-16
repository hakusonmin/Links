<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase title="アカウント作成" description="">
        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label class="font-bold" for="name">氏名</Label>
                    <Input id="name" type="text" class=" border-gray-500" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="山田 太郎" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label class="font-bold" for="email">メールアドレス</Label>
                    <Input id="email" type="email" required class=" border-gray-500" :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label class="font-bold" for="password">パスワード</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        class=" border-gray-500"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="パスワード"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label class="font-bold" for="password_confirmation">パスワードを再度入力してください</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        class=" border-gray-500"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="パスワード"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="mt-2 w-full bg-black" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    作成
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground font-bold">
                すでにアカウントを持っていますか？
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">ログイン</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
