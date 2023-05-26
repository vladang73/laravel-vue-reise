export default {
    data() {
        return {
            currentSort: 'id',
            currentSortDir: 'asc',
            pageSize: 10,
            currentPage: 1,
            pagesCount: 0,
            pageSizes: [10, 25, 50, 100]
        }
    },

    methods: {
        nextPage() {
            if((this.currentPage*this.pageSize) < this.list.length) {
                this.currentPage++;
            }
        },
        previousPage() {
            if(this.currentPage > 1) {
                this.currentPage--;
            }
        },
        selectPage(num = 1) {
            this.currentPage = num;
        },
        setPageSize(size = 10) {
            this.pageSize = size;
        },
        sort(param) {
            if(param === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = param;
        },
    }
}