<script>
export default {
    name: "drop-file",
    props: {
        ImageValue: {
            type: String,
            required: false,
        },
    },
    data() {
        return {
            formType: "basic",
            imgSource: "",
            containerStyle: { backgroundRepeat: "no-repeat" },
            backgroundImage: "",
            hasFile: false,
            fileName: "",
        };
    },
    mounted() {
        if (this.ImageValue != null && this.ImageValue != "") {
            this.backgroundImage = "url(" + this.ImageValue + ")";
        }
    },
    methods: {
        dragOver(e) {
            e.preventDefault();
        },
        dragDrop(e) {
            e.preventDefault();
            var app = this;
            let dt = e.dataTransfer;
            let files = dt.files;
            const file = files[0];
            app.$refs.FileInput.files = files;
            app.fileName = file.name;
            app.imgSource = URL.createObjectURL(file);
            app.backgroundImage = "url(" + this.imgSource + ")";
            app.hasFile = true;
            this.$parent.$emit("video-uploaded", file);
        },
        fileChanged(e) {
            const file = e.target.files[0];
            this.fileName = file.name;
            this.imgSource = URL.createObjectURL(file);
            this.backgroundImage = "url(" + this.imgSource + ")";
            this.hasFile = true;
            this.$parent.$emit("video-uploaded", file);
        },
        removeFile() {
            this.hasFile = false;
            this.fileName = "";
            this.imgSource = null;
            this.backgroundImage = "";
            this.$parent.$emit("video-removed");
        },
    },
};
</script>
