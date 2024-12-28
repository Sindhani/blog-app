import {defineStore} from 'pinia';
import {localAxios as axios} from 'boot/axios.js';
import {route} from 'boot/ziggy.js'

export const useBlogStore = defineStore('blog', {
    // State
    state: () => ({
        blogs: [],
        blogDetail: null,
        currentPage: 1,
        totalPages: 0,
        isLoading: false,
        error: null,
    }),

    // Actions
    actions: {
        async fetchBlogs(page = 1) {
            if (this.isLoading || (this.totalPages && page > this.totalPages)) {
                return;
            }
            this.isLoading = true;
            this.error = null;
            try {
                const response = await axios.get(route('blogs.index'), {
                    params: {page},
                });

                const {data, meta} = response.data;
                this.blogs = page === 1 ? data : this.blogs.concat(data);
                this.currentPage = meta.current_page;
                this.totalPages = meta.total;
            } catch (err) {
                this.error = err.message || 'Failed to fetch blogs.';
            } finally {
                this.isLoading = false;
            }
        },

        async fetchBlogDetail(slug) {
            this.isLoading = true;
            this.error = null;

            try {
                const response = await axios.get(route('blogs.show', {blog: slug}));
                this.blogDetail = response.data;
            } catch (err) {
                this.error = err.message || 'Failed to fetch blog details.';
            } finally {
                this.isLoading = false;
            }
        },
        async addComment(blog, message) {
            if (!message.trim()) {
                this.error = 'Comment message cannot be empty.';
                return;
            }
            try {
                this.isLoading = true;
                this.error = null;

                const response = await axios.post(route('blogs.comments.store', {blog: blog}), {content: message});
                const newComment = response.data;

                if (this.blogDetail && this.blogDetail.slug === blog) {
                    this.blogDetail.comments.push(newComment.data);
                }

                return newComment;
            } catch (err) {
                console.log(err)
                this.error = err.message || 'Failed to add comment.';
            } finally {
                this.isLoading = false;
            }
        },
    },
});