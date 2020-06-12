const getters = {
    user: state => {
        return state.user;
    },
    loggedIn: state => {
        return null !== state.user;
    },
    initialized: state => {
        return null !== state.user && state.user.initialized;
    }
};

export default getters;
