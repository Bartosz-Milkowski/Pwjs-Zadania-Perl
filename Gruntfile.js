module.exports = function (grunt) {

    require('load-grunt-tasks')(grunt);

    /*
    ustawcie sobie zmienną systemową JOOMLA_HOME ze ścieżką do katalogu z zainstalowaną joomlą
     */
    const joomla_home = process.env.JOOMLA_HOME ? process.env.JOOMLA_HOME : 'C:/Develop/praktyki_joomla';
    console.log("Ścieżka do joomla: " + joomla_home);

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            options: {
                implementation: require('node-sass'),
                sourceMap: false                
            },
            dist: {
                files: {
                    'build/site/css/zaswiadczenia.css': 'src/site/scss/zaswiadczenia.scss'
                }
            }
        },
        // postcss: {
        //     options: {
        //         processors: [
        //                 require('autoprefixer')({
        //                 browsers: 'last 20 versions'
        //             })],
        //     },
        //     dist: {
        //         src: 'build/site/css/*.css'
        //     }
        // },
        compress: {
            main: {
                options: {
                    archive: 'dist/<%= pkg.name %>_<%= pkg.version %>.zip'
                },
                files: [{
                    expand: true,
                    cwd: 'build',
                    src: '**'
                }]
            }
        },
        copy: {
            main: {
                files: [{
                    expand: true,
                    cwd: 'src',
                    src: ['**', '!site/scss/**'],
                    dest: 'build/'
                }],
            },
            vendor: {
                files: [{
                    expand: true,
                    cwd: '',
                    src: ['vendor/**'],
                    dest: 'build/site' 
                }],
            },
            toLocalJoomla: {
                files: [{
                    expand: true,
                    cwd: 'build/site',
                    src: ['**'],
                    dest: joomla_home + '/components/com_zaswiadczenia'
                },{
                    expand: true,
                    cwd: 'build/admin',
                    src: ['**'],
                    dest: joomla_home + '/administrator/components/com_zaswiadczenia'
                }]
            }
        },
        /**
         * przepisanie metadanych projektu z package.json do manifestu komponentu joomla
         **/
        xmlpoke: {
            manifestFromPkg: {
                options: {
                    replacements: [
                        {
                            xpath: '/extension/author',
                            value: '<%= pkg.author.name %>'
                        }, {
                            xpath: '/extension/authorEmail',
                            value: '<%= pkg.author.email %>'
                        }, {
                            xpath: '/extension/authorUrl',
                            value: '<%= pkg.author.url %>'
                        }, {
                            xpath: '/extension/version',
                            value: '<%= pkg.version %>'
                        }
                    ]
                },
                files: {
                    'build/zaswiadczenia.xml': 'src/zaswiadczenia.xml'
                },
            },
        },
        clean: {
            build: ['build'],
            release: ['dist']
        }
    });

    grunt.registerTask('default', ['clean:build','copy:main', 'xmlpoke', 'sass']);
    grunt.registerTask('package-lite', ['clean', 'copy:main', 'xmlpoke', 'sass', 'compress']);
    grunt.registerTask('package', ['clean', 'copy:main', 'copy:vendor', 'xmlpoke', 'sass', 'compress']);
    grunt.registerTask('deploy-local', ['clean', 'copy:main', 'xmlpoke', 'sass', 'copy:toLocalJoomla']);
};
