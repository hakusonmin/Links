<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// Components
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
  password: '',
});

const deleteUser = (e: Event) => {
  e.preventDefault();

  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  form.clearErrors();
  form.reset();
};
</script>

<template>
  <div class="space-y-6 mt-6">
    <HeadingSmall title="アカウント削除" description="" />
    <Dialog>
      <DialogTrigger as-child>
        <Button variant="destructive" class="bg-black">削除する</Button>
      </DialogTrigger>
      <DialogContent>
        <form class="space-y-6" @submit="deleteUser">
          <DialogHeader class="space-y-3">
            <DialogTitle>本当にアカウントを削除しますか？</DialogTitle>
            <DialogDescription> 一度アカウントを削除すると二度とリソースを復旧することは出来ません。 </DialogDescription>
          </DialogHeader>

          <div class="grid gap-2">
            <Label for="password" class="sr-only">Password</Label>
            <Input id="password" type="password" name="password" ref="passwordInput" v-model="form.password" placeholder="パスワード" />
            <InputError :message="form.errors.password" />
          </div>

          <DialogFooter class="gap-2">
            <DialogClose as-child>
              <Button variant="secondary" @click="closeModal"> キャンセル </Button>
            </DialogClose>

            <Button variant="destructive" :disabled="form.processing">
              <button  type="submit">削除する</button>
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  </div>
</template>
