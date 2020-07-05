import { getLocalUser } from "./helpers/auth";/*fct faite dans le auth.js*/

const user = getLocalUser();

export default {/*cet objet représente les datas dont on a besoin dans notre store*/
    state: {
        currentUser: user,
        isLoggedIn: !!user,/*!! boolean*/
        loading: false,
        auth_error: null,
        reg_error: null,
        comments:[]
    },
    /*ces fct seront appelées dans les components pour prendre keys du store*/ 
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        regError(state){
            return state.reg_error; 
        },    
           
        comments(state){
            return state.comments;
        }
    },
    /*faut que ca soit méme que dans methode de login.vue*/
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token}, {expire: payload.expires_in});
            /*currentUser=user+acce_stoken*/ 
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateInfoUser(state, payload){
            state.currentUser.email = payload.email;
            state.currentUser.name = payload.name;
            state.currentUser.username = payload.username;
            state.currentUser.bio = payload.bio;       
        },
        registerFailed(state, payload){
            state.reg_error = payload.error;
        },
        CREATE_COMMENT(state, comment){
            state.comments.unshift(comment)
        },
        
        DELETE_COMMENT(state, comment) {
            let index = state.comments.findIndex(item => item.id === comment.id)
            state.comments.splice(index, 1)
        }        
    },
    actions: {
        login(context) {
            context.commit("login");/*login de mutation*/
        },
        createComment({commit}, comment) {
            axios.post('/api/coms/comments', comment)
                .then(res => {
                    commit('CREATE_COMMENT', res.data)
                }).catch(err => {
                console.log(err)
            })

        },
    
        deleteComment({commit}, comment) {
            axios.delete(`/api/coms/comments/${comment.id}`)
                .then(res => {
                    if (res.data === 'ok')
                        commit('DELETE_COMMENT', comment)
                }).catch(err => {
                console.log(err)
            })
        }
    }
};