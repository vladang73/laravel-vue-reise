<template>
    <div id="app">
        <div class="container">
            <!--UPLOAD-->
            <form enctype="multipart/form-data" novalidate v-if="isInitial || isSaving">
                <div class="dropbox">
                    <input type="file" name="file" :disabled="isSaving" v-on:change="onInputChange" accept="image/*" class="input-file">
                    <p v-if="isInitial">
                        {{ $t('common.dragPhoto') }}<br> {{ $t('common.clickBrowse') }}
                    </p>
                    <p v-if="isSaving">
                        {{ $t('common.uploading') }}
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

<style lang="scss">
</style>

<script>
    import api from '@admin/api';

    const STATUS_INITIAL = 0,
        STATUS_SAVING = 1,
        STATUS_SUCCESS = 2,
        STATUS_FAILED = 3;

    export default {
        name: 'app',
        props: ['showInitial'],
        data() {
            return {
                uploadError: null,
                currentStatus: null,
                uploadFieldName: 'photos',
                imageName: ''
            }
        },
        computed: {
            isInitial() {
                return this.currentStatus === STATUS_INITIAL;
            },
            isSaving() {
                return this.currentStatus === STATUS_SAVING;
            },
            isSuccess() {
                return this.currentStatus === STATUS_SUCCESS;
            },
            isFailed() {
                return this.currentStatus === STATUS_FAILED;
            }
        },
        watch: {
            showInitial() {
                if(true === this.showInitial) {
                    this.currentStatus = STATUS_INITIAL;
                }
            }
        },
        methods: {
            reset() {
                // reset form to initial state
                this.currentStatus = STATUS_INITIAL;
                this.uploadError = null;
            },
            onInputChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;
                }
                if (['image/x-png', 'image/png', 'image/gif', 'image/jpeg'].indexOf(files[0].type) != -1) {
                    this.imageName = files[0].name;
                    this.createImage(files[0]);
                }
            },
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.uploadImage(e.target.result);
                };
                reader.readAsDataURL(file);
            },
            uploadImage(image) {
                api.postRequest(api.urls.upload.avatar, {'image': image})
                    .then(res => {
                        this.currentStatus = STATUS_SUCCESS;
                        this.$emit('file-path', res.data.path);
                        this.$emit('visible-name', this.imageName);
                    })
                    .catch(err => {
                        this.currentStatus = STATUS_FAILED;
                    });
            },
        },
        mounted() {
            this.reset();
        },
    }
</script>
