
import ApiService from "@/core/services/api.service";
import JwtService from "@/core/services/jwt.service";
// import { localStorage } from "window";


// action types
export const VERIFY_AUTH = "verifyAuth";
export const LOGIN = "login"; 
export const LOGOUT = "logout";
export const REGISTER = "register";
export const UPDATE_PASSWORD = "updateUser";

// mutation types
export const PURGE_AUTH = "logOut";
export const SET_AUTH = "setUser";
export const SET_PASSWORD = "setPassword";
export const SET_ERROR = "setError";
// export const SET_TOKEN = "setToken";
export const SET_ROLE = "setRole";


const initializeState = () => {
  const token = JwtService.getToken();
  const user = JSON.parse(localStorage.getItem("user")) || {};
  const isAuthenticated = !!token;

  return {
    role: null,
    errors: null,
    user,
    isAuthenticated,
  };
};

const state = initializeState();
// const state = {
//   // token: null,
//   role: null,
//   errors: null,
//   user: {},
//   isAuthenticated: !!JwtService.getToken()
// };

const getters = {
  // currentUser(state) {
  //   return state.user;
  // },
  currentUser: (state) => state.user, // Mengambil data pengguna dari state

  isAuthenticated(state) {
    return state.isAuthenticated;
  }
};

const actions = {
  [LOGIN](context, payload) {
    return new Promise((resolve, reject) => {
      ApiService.post("user/login", payload)
        .then(({ data }) => {
          context.commit(SET_AUTH, data);
          // context.commit(SET_TOKEN, data.token); // Memanggil mutasi setToken
          context.commit(SET_ROLE, data.role);   // Memanggil mutasi setRole
          resolve(data);
        })
        .catch(({ response }) => {
          context.commit(SET_ERROR, response.data.errors);
          reject(response);
        });
    });
  },


  [LOGOUT](context) {
    context.commit(PURGE_AUTH);
    return new Promise(resolve => {
      resolve();
    });
  },

  [REGISTER](context, payload) {
    return new Promise((resolve, reject) => {
      ApiService.post("user/register", payload)
        .then((response) => {
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        });
    });
  },
  // [REGISTER](context, credentials) {
  //   return new Promise(resolve => {
  //     ApiService.post("login", credentials)
  //       .then(({ data }) => {
  //         context.commit(SET_AUTH, data);
  //         resolve(data);
  //       })
  //       .catch(({ response }) => {
  //         context.commit(SET_ERROR, response.data.errors);
  //       });
  //   });
  // },
  [VERIFY_AUTH](context) {
    if (JwtService.getToken()) {
      ApiService.setHeader();
      ApiService.get("verify")
        .then(({ data }) => {
          context.commit(SET_AUTH, data);
        })
        .catch(({ response }) => {
          context.commit(SET_ERROR, response.data.errors);
        });
    } else {
      context.commit(PURGE_AUTH);
    }
  },
  [UPDATE_PASSWORD](context, payload) {
    const password = payload;

    return ApiService.put("password", password).then(({ data }) => {
      context.commit(SET_PASSWORD, data);
      return data;
    });
  }
};

const mutations = {
  [SET_ERROR](state, error) {
    state.errors = error;
  },
  // [SET_AUTH](state, user) {
  //   state.isAuthenticated = true;
  //   state.user = user;
  //   state.errors = {};
  //   JwtService.saveToken(state.user.token);
  // },
  [SET_AUTH](state, data) {
    state.isAuthenticated = true;
    // state.data = data;s
    state.user = data.data;
    state.errors = {};
    JwtService.saveToken(data.data.token);
    localStorage.setItem("user", JSON.stringify(data.data)); // Simpan data pengguna ke localStorage
    localStorage.removeItem('loglevel:webpack-dev-server');
    console.log("Data pengguna tersimpan di localStorage:", localStorage.getItem("user"));
  },
  // [SET_PASSWORD](state, password) {
  //   state.user.password = password;
  // },
  [SET_PASSWORD](state, password) {
    state.data.password = password;
  },
  // [PURGE_AUTH](state) {
  //   state.isAuthenticated = false;
  //   state.user = {};
  //   state.errors = {};
  //   JwtService.destroyToken();
  // }
  [PURGE_AUTH](state) {
    state.isAuthenticated = false;
    state.data = {};
    state.errors = {};
    JwtService.destroyToken();
    localStorage.removeItem("user"); // Hapus data pengguna dari localStorage
    localStorage.removeItem("id"); // Hapus data pengguna dari localStorage
    console.log("Data pengguna tersimpan di localStorage:", localStorage.getItem("user"));
  },

//  [SET_TOKEN](state, token) {
//     state.token = token;
//   },
  [SET_ROLE](state, role) {
    state.role = role;
  },
};

export default {
  state,
  actions,
  mutations,
  getters
};
