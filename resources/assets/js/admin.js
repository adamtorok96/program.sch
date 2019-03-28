window.d3 = require('d3');

class ProgramSchAdmin {
    static timeParse(date) {
        return d3.isoParse(date);
    }

    static timeFormat(format) {
        if (typeof (format) === 'undefined')
            format = '%Y. %m. %d. %H:%M';

        return d3.timeFormat(format);
    }

    static time(date, format) {
        return (ProgramSchAdmin.timeFormat(format))(ProgramSchAdmin.timeParse(date));
    }

    static formatDate(value) {
        return ProgramSchAdmin.time(value);
    }

    static formatEmail(value) {
        return '<a href="mailto:' + value + '">' + value + '</a>';
    }

    static formatResort(value, data) {
        return data.resort === null
            ? 'Nincs reszorthoz rendelve'
            : laroute.link_to_route('admin.resorts.show', value, {
                resort: data.resort.id
        });
    }

    static formatCircle(value, data) {
        return laroute.link_to_route('admin.circles.show', value, {
            circle: data.circle.id
        });
    }

    static formatUser(value, data) {
        return laroute.link_to_route('admin.users.show', value, {
            user: data.user.id
        });
    }

    static get Programs() {
        return class {
            static reloadTable() {
                $("table[data-toggle='table']").bootstrapTable('refresh');
            }

            static queryParams(params) {
                if( $("#only_poster").is(":checked") )
                    params.only_poster = true;

                if( $("#only_email").is(":checked") )
                    params.only_email = true;

                return params;
            }

            static formatName(value, data) {
                return laroute.link_to_route('admin.programs.show', value, {
                    program: data.id
                });
            }
        }
    }

    static get Resorts() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.resorts.show', value, {
                    resort: data.id
                });
            }
        }
    }

    static get Circles() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.circles.show', value, {
                    circle: data.id
                });
            }
        }
    }

    static get Users() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.users.show', value, {
                    user: data.id
                });
            }
        }
    }

    static get Locations() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.locations.show', value, {
                    location: data.id
                });
            }
        }
    }
}

window.PSA = ProgramSchAdmin;