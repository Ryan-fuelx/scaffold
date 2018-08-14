<template>
  <el-row class="post-editor-page" v-loading="loading">
    <el-col :span="11">
      <editor-title :name="$t('post.title')"></editor-title>

      <el-form label-position="right" label-width="80px" :rules="rules" :model="form"
               ref="form">

        <form-item :label="$t('global.fields.id')" v-if="form.id">
          <el-input v-model="form.id" disabled></el-input>
        </form-item>
                    <form-item :label="$t('post.fields.title')" prop="title">
              <el-input v-model="form.title"></el-input>
            </form-item>
            <form-item :label="$t('post.fields.content')" prop="content">
              <el-input v-model="form.content"></el-input>
            </form-item>
            <form-item :label="$t('post.fields.password')" prop="password">
              <el-input v-model="form.password"></el-input>
            </form-item>
            <form-item :label="$t('post.fields.email')" prop="email">
              <el-input v-model="form.email"></el-input>
            </form-item>
            <form-item :label="$t('post.fields.category')" prop="category">
              <el-input v-model="form.category"></el-input>
            </form-item>
            <form-item :label="$t('post.fields.status')" prop="status">
              <el-input v-model="form.status"></el-input>
            </form-item>
            <form-item :label="$t('post.fields.created_by')" prop="created_by">
              <el-input v-model="form.created_by"></el-input>
            </form-item>
            <form-item :label="$t('post.fields.comments')">
              <multiselect v-model="form.comments" label="id" track-by="id"
                           :multiple="true" :placeholder="$t('scaffold.terms.input_to_search')" 
                           open-direction="bottom" :options="_commentsList" :searchable="true" 
                           @search-change="_queryCommentsList">
              </multiselect>
            </form-item>
        <form-item :label="$t('global.fields.created_at')" v-if="form.id">
          <el-input v-model="form.created_at" disabled></el-input>
        </form-item>

        <form-item>
          <el-button type="primary" @click="isCreating?onCreate():onUpdate()">
            {{$t('global.terms.submit')}}
          </el-button>
          <el-button @click="$router.go(-1)">{{$t('global.terms.back')}}</el-button>
        </form-item>
      </el-form>
    </el-col>
    <el-col :span="11" :offset="1"></el-col>
  </el-row>
</template>

<script type="javascript">
  import store  from '@/store'
  import { mapState } from 'vuex'
  import { SuccessMessage } from '@/utils/message'
  import { PostStore, PostUpdate, PostShow } from '@/api/post'
  import EditorMixin from '@/mixins/Editor'

  export default  {
    components: {},
    mixins: [EditorMixin],
    data () {
      return {
        rules: {},
        form: {
    "title": null,
    "content": null,
    "password": null,
    "email": null,
    "category": null,
    "status": 1,
    "created_by": null,
    "comments": null
}
      };
    },
    computed: {
      ...mapState({
//        items: state => state.model.items
      })
    },
//    beforeRouteEnter(to, from, next){
//      Preload store data here.
//      store.dispatch('user/LoadRoles').then(next);
//    },
    mounted () {
      this.fetchData();
    },
    watch: {
      $route: 'fetchData',
    },
    methods: {
      fetchData() {
        if (this.$route.params.id) {
          this.loading = true;
          PostShow(this.$route.params.id, '_with=roles')
            .then(res => this.setFormData(res.data))
            .then(res => this.loading = false)
        }
      },
      setFormData(rawFormData){
        this.form = rawFormData
      },
      onCreate () {
        this.$refs.form.validate().then(valid => {
          this.loading = true;
          return PostStore('_with=roles', this.form);
        })
          .then(SuccessMessage(this.$t('global.terms.save_completed')))
          .then(res => {
            this.loading = false;
            this.$router.replace({ path: `/post/post/${this.form.id}/edit` });
          })
          .catch(this.errorHandler);
      },
      onUpdate () {
        this.$refs.form.validate().then(valid => {
          this.loading = true;
          return PostUpdate(this.form.id, '_with=roles', this.form)
        })
          .then(res => this.setFormData(res.data))
          .then(SuccessMessage(this.$t('global.terms.save_completed')))
          .then(res => this.loading = false)
          .catch(this.errorHandler);
      }
    }
  };
</script>

<style rel="stylesheet/scss" lang="scss">
  .post-editor-page{
    margin: 10px 30px;
  }
</style>
