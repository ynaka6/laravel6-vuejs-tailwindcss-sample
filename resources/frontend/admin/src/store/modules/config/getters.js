const getters = {
    const: state => {
        return state.const;
    },
    adminRoleOption: state => {
        let option = [{ text: "選択して下さい", value: null }];
        if (state.const && state.const.adminRoles) {
            option.push(
                ...Object.keys(state.const.adminRoles).map(v => ({
                    text: state.const.adminRoles[v],
                    value: v
                }))
            );
        }
        return option;
    }
};

export default getters;
