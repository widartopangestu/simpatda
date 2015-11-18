--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: access_log_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE access_log_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE access_log_seq OWNER TO simpatdadb;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: access_log; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE access_log (
    id integer DEFAULT nextval('access_log_seq'::regclass) NOT NULL,
    type smallint,
    activity text,
    user_id integer NOT NULL,
    "time" timestamp without time zone
);


ALTER TABLE access_log OWNER TO simpatdadb;

--
-- Name: bidang_usaha; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bidang_usaha (
    id integer NOT NULL,
    kode character varying(3) NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE bidang_usaha OWNER TO postgres;

--
-- Name: bidang_usaha_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE bidang_usaha_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE bidang_usaha_id_seq OWNER TO postgres;

--
-- Name: bidang_usaha_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE bidang_usaha_id_seq OWNED BY bidang_usaha.id;


--
-- Name: golongan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE golongan (
    id integer NOT NULL,
    nama character varying(10) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE golongan OWNER TO simpatdadb;

--
-- Name: golongan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE golongan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE golongan_id_seq OWNER TO simpatdadb;

--
-- Name: golongan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE golongan_id_seq OWNED BY golongan.id;


--
-- Name: jabatan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE jabatan (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE jabatan OWNER TO simpatdadb;

--
-- Name: jabatan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE jabatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE jabatan_id_seq OWNER TO simpatdadb;

--
-- Name: jabatan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE jabatan_id_seq OWNED BY jabatan.id;


--
-- Name: jenis_surat; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE jenis_surat (
    id integer NOT NULL,
    kode character varying(1) NOT NULL,
    nama character varying(255) NOT NULL,
    singkatan character varying(20),
    is_official boolean DEFAULT true NOT NULL,
    is_self boolean DEFAULT true NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE jenis_surat OWNER TO simpatdadb;

--
-- Name: jenis_surat_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE jenis_surat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE jenis_surat_id_seq OWNER TO simpatdadb;

--
-- Name: jenis_surat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE jenis_surat_id_seq OWNED BY jenis_surat.id;


--
-- Name: kecamatan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE kecamatan (
    id integer NOT NULL,
    kode character varying(2) NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE kecamatan OWNER TO simpatdadb;

--
-- Name: kecamatan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE kecamatan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kecamatan_id_seq OWNER TO simpatdadb;

--
-- Name: kecamatan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE kecamatan_id_seq OWNED BY kecamatan.id;


--
-- Name: kelurahan; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE kelurahan (
    id integer NOT NULL,
    kode character varying(2) NOT NULL,
    nama character varying(255) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone,
    kecamatan_id integer NOT NULL
);


ALTER TABLE kelurahan OWNER TO simpatdadb;

--
-- Name: kelurahan_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE kelurahan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kelurahan_id_seq OWNER TO simpatdadb;

--
-- Name: kelurahan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE kelurahan_id_seq OWNED BY kelurahan.id;


--
-- Name: kode_rekening; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE kode_rekening (
    id integer NOT NULL,
    kode character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    tarif_persen double precision,
    tarif_dasar double precision,
    created timestamp without time zone,
    updated timestamp without time zone,
    parent_id integer
);


ALTER TABLE kode_rekening OWNER TO simpatdadb;

--
-- Name: kode_rekening_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE kode_rekening_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE kode_rekening_id_seq OWNER TO simpatdadb;

--
-- Name: kode_rekening_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE kode_rekening_id_seq OWNED BY kode_rekening.id;


--
-- Name: message_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE message_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE message_seq OWNER TO simpatdadb;

--
-- Name: message; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE message (
    id integer DEFAULT nextval('message_seq'::regclass) NOT NULL,
    language character varying(16) NOT NULL,
    translation text
);


ALTER TABLE message OWNER TO simpatdadb;

--
-- Name: operation_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE operation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE operation_seq OWNER TO simpatdadb;

--
-- Name: operation; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE operation (
    id integer DEFAULT nextval('operation_seq'::regclass) NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    nama_modul character varying(255) NOT NULL,
    grup smallint DEFAULT 1 NOT NULL,
    urutan_ke smallint DEFAULT 1 NOT NULL,
    tampilkan_dirole smallint DEFAULT 1 NOT NULL
);


ALTER TABLE operation OWNER TO simpatdadb;

--
-- Name: pangkat; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE pangkat (
    id integer NOT NULL,
    nama character varying(100) NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE pangkat OWNER TO simpatdadb;

--
-- Name: pangkat_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE pangkat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pangkat_id_seq OWNER TO simpatdadb;

--
-- Name: pangkat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE pangkat_id_seq OWNED BY pangkat.id;


--
-- Name: pejabat; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE pejabat (
    id integer NOT NULL,
    kode character varying(2) NOT NULL,
    nama character varying(255) NOT NULL,
    nip character varying(30) NOT NULL,
    status boolean DEFAULT true NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone,
    golongan_id integer NOT NULL,
    jabatan_id integer NOT NULL,
    pangkat_id integer NOT NULL
);


ALTER TABLE pejabat OWNER TO simpatdadb;

--
-- Name: pejabat_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE pejabat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pejabat_id_seq OWNER TO simpatdadb;

--
-- Name: pejabat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE pejabat_id_seq OWNED BY pejabat.id;


--
-- Name: role_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE role_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE role_seq OWNER TO simpatdadb;

--
-- Name: role; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE role (
    id integer DEFAULT nextval('role_seq'::regclass) NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE role OWNER TO simpatdadb;

--
-- Name: role_access; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE role_access (
    role_id integer NOT NULL,
    operation_id integer NOT NULL
);


ALTER TABLE role_access OWNER TO simpatdadb;

--
-- Name: sourcemessage_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE sourcemessage_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sourcemessage_seq OWNER TO simpatdadb;

--
-- Name: sourcemessage; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE sourcemessage (
    id integer DEFAULT nextval('sourcemessage_seq'::regclass) NOT NULL,
    category character varying(32),
    message text
);


ALTER TABLE sourcemessage OWNER TO simpatdadb;

--
-- Name: user_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_seq OWNER TO simpatdadb;

--
-- Name: user; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE "user" (
    id integer DEFAULT nextval('user_seq'::regclass) NOT NULL,
    username character varying(255) NOT NULL,
    image character varying(255) DEFAULT 'no_image.png'::character varying NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    fullname character varying(255) DEFAULT NULL::character varying,
    phone_1 character varying(15) DEFAULT NULL::character varying,
    phone_2 character varying(15) DEFAULT NULL::character varying,
    address text,
    status smallint NOT NULL,
    last_login timestamp without time zone,
    activkey character varying(45) DEFAULT NULL::character varying,
    role_id integer
);


ALTER TABLE "user" OWNER TO simpatdadb;

--
-- Name: v_userlist; Type: VIEW; Schema: public; Owner: simpatdadb
--

CREATE VIEW v_userlist AS
 SELECT a.id,
    a.username,
    a.image,
    a.password,
    a.email,
    a.fullname,
    a.phone_1,
    a.phone_2,
    a.address,
    a.status,
    a.last_login,
    a.activkey,
    a.role_id,
    b.name AS namarole
   FROM ("user" a
     JOIN role b ON ((a.role_id = b.id)))
  ORDER BY a.username;


ALTER TABLE v_userlist OWNER TO simpatdadb;

--
-- Name: v_userlog; Type: VIEW; Schema: public; Owner: simpatdadb
--

CREATE VIEW v_userlog AS
 SELECT a.id,
    a.type,
    a.activity,
    a."time",
    a.user_id,
    b.username
   FROM (access_log a
     JOIN "user" b ON ((a.user_id = b.id)));


ALTER TABLE v_userlog OWNER TO simpatdadb;

--
-- Name: wajib_pajak; Type: TABLE; Schema: public; Owner: simpatdadb; Tablespace: 
--

CREATE TABLE wajib_pajak (
    id bigint NOT NULL,
    jenis character varying(1) NOT NULL,
    golongan smallint DEFAULT 1 NOT NULL,
    nomor character varying(7) NOT NULL,
    nama character varying(255) NOT NULL,
    alamat text,
    kabupaten character varying(255) NOT NULL,
    kecamatan character varying(255) NOT NULL,
    kelurahan character varying(255) NOT NULL,
    telepon character varying(20) NOT NULL,
    status boolean DEFAULT true NOT NULL,
    tanggal_tutup date,
    kodepos character varying(5) NOT NULL,
    id_jenis integer,
    id_nomor character varying(255) DEFAULT NULL::character varying,
    tanggal_lahir date,
    kk_nomor character varying(255) DEFAULT NULL::character varying,
    kk_tanggal timestamp without time zone,
    pekerjaan character varying(255) DEFAULT NULL::character varying,
    alamat_pekerjaan text,
    bu_nama character varying(255) DEFAULT NULL::character varying,
    bu_alamat text,
    bu_kabupaten character varying(255) DEFAULT NULL::character varying,
    bu_kecamatan character varying(255) DEFAULT NULL::character varying,
    bu_kelurahan character varying(255) DEFAULT NULL::character varying,
    bu_telepon character varying(20) DEFAULT NULL::character varying,
    bu_kodepos character varying(5) DEFAULT NULL::character varying,
    kelurahan_id integer,
    kecamatan_id integer,
    bidang_usaha_id integer,
    warga_negara character varying(5) DEFAULT 'WNI'::character varying NOT NULL,
    created timestamp without time zone,
    updated timestamp without time zone
);


ALTER TABLE wajib_pajak OWNER TO simpatdadb;

--
-- Name: wajib_pajak_id_seq; Type: SEQUENCE; Schema: public; Owner: simpatdadb
--

CREATE SEQUENCE wajib_pajak_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE wajib_pajak_id_seq OWNER TO simpatdadb;

--
-- Name: wajib_pajak_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: simpatdadb
--

ALTER SEQUENCE wajib_pajak_id_seq OWNED BY wajib_pajak.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY bidang_usaha ALTER COLUMN id SET DEFAULT nextval('bidang_usaha_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY golongan ALTER COLUMN id SET DEFAULT nextval('golongan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY jabatan ALTER COLUMN id SET DEFAULT nextval('jabatan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY jenis_surat ALTER COLUMN id SET DEFAULT nextval('jenis_surat_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kecamatan ALTER COLUMN id SET DEFAULT nextval('kecamatan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kelurahan ALTER COLUMN id SET DEFAULT nextval('kelurahan_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kode_rekening ALTER COLUMN id SET DEFAULT nextval('kode_rekening_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pangkat ALTER COLUMN id SET DEFAULT nextval('pangkat_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat ALTER COLUMN id SET DEFAULT nextval('pejabat_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak ALTER COLUMN id SET DEFAULT nextval('wajib_pajak_id_seq'::regclass);


--
-- Data for Name: access_log; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY access_log (id, type, activity, user_id, "time") FROM stdin;
2	0	404 Tidak bisa mengurai request "zadad" - Access Page : "/simpatda/zadad"	1	2015-11-18 06:29:45.722
3	3	Laporan Log Pengguna	1	2015-11-18 06:31:19.126
4	0	Caught Exception: Resource /reports/simpatda_new/ag_user_list not found.	1	2015-11-18 06:32:17.129
5	3	Manage Bidang Usaha	1	2015-11-18 07:05:46.712
6	3	Manage Golongan	1	2015-11-18 07:09:52.098
7	2	Create Golongan ID : 1	1	2015-11-18 07:10:07.318
8	3	Manage Golongan	1	2015-11-18 07:10:07.558
9	3	Manage Jabatan	1	2015-11-18 07:10:16.027
10	2	Create Jabatan ID : 1	1	2015-11-18 07:10:37.028
11	3	Manage Jabatan	1	2015-11-18 07:10:37.27
12	3	Manage Jenis Surat	1	2015-11-18 07:10:48.308
13	3	Manage Kecamatan	1	2015-11-18 07:11:10.709
14	3	Manage Kelurahan	1	2015-11-18 07:11:15.396
15	3	Manage Kode Rekening	1	2015-11-18 07:11:32.037
16	3	Manage Pangkat	1	2015-11-18 07:12:08.646
17	3	Manage Pangkat	1	2015-11-18 07:12:44.55
18	3	Manage Pejabat	1	2015-11-18 07:12:55.738
19	3	Manage Wajib Pajak	1	2015-11-18 07:13:31.265
20	3	View Profile	1	2015-11-18 07:15:28.146
21	3	View Profile	1	2015-11-18 07:16:45.006
22	3	View Profile	1	2015-11-18 07:17:31.943
23	3	View Profile	1	2015-11-18 07:17:48.916
24	3	Manage Kelurahan	1	2015-11-18 07:26:49.003
25	3	Manage Pejabat	1	2015-11-18 07:39:33.884
26	3	Manage Pejabat	1	2015-11-18 07:39:43.862
27	3	Manage Pejabat	1	2015-11-18 07:39:47.402
28	3	Manage Pejabat	1	2015-11-18 07:40:21.807
29	3	Manage Pejabat	1	2015-11-18 07:40:23.66
30	3	Manage Pejabat	1	2015-11-18 07:40:26.513
31	3	Manage Pejabat	1	2015-11-18 07:40:28.768
32	3	Manage Kecamatan	1	2015-11-18 07:41:43.28
33	2	Create Kecamatan ID : 1	1	2015-11-18 07:43:28.653
34	3	Manage Kecamatan	1	2015-11-18 07:43:28.943
35	3	Manage Kelurahan	1	2015-11-18 07:43:34.713
36	2	Create Kelurahan ID : 1	1	2015-11-18 07:49:15.976
37	3	Manage Kelurahan	1	2015-11-18 07:49:16.207
38	3	Manage Kelurahan	1	2015-11-18 07:49:20.691
39	3	Manage Kelurahan	1	2015-11-18 07:49:22.233
40	3	Manage Jabatan	1	2015-11-18 07:49:31.813
41	2	Update Jabatan ID : 1	1	2015-11-18 07:49:49.91
42	3	Manage Jabatan	1	2015-11-18 07:49:50.135
43	3	Manage Pangkat	1	2015-11-18 07:49:56.605
44	2	Create Pangkat ID : 1	1	2015-11-18 07:50:09.654
45	3	Manage Pangkat	1	2015-11-18 07:50:09.878
46	3	Manage Pejabat	1	2015-11-18 07:50:22.11
47	2	Create Pejabat ID : 1	1	2015-11-18 07:50:49.3
48	3	View Pejabat ID : 1	1	2015-11-18 07:50:49.551
49	3	View Pejabat ID : 1	1	2015-11-18 07:58:14.793
50	2	Delete Pejabat ID : 1	1	2015-11-18 07:59:01.748
51	3	Manage Pejabat	1	2015-11-18 07:59:02.029
52	3	Manage Wajib Pajak	1	2015-11-18 07:59:21.061
53	3	Manage Pejabat	1	2015-11-18 08:00:37.956
54	3	Manage Kelurahan	1	2015-11-18 08:17:49.73
55	3	Manage Kecamatan	1	2015-11-18 08:18:00.841
56	2	Delete Kecamatan ID : 1	1	2015-11-18 08:18:05.942
57	3	Manage Kecamatan	1	2015-11-18 08:18:06.185
58	3	Manage Kelurahan	1	2015-11-18 08:18:21.542
59	3	Manage Kecamatan	1	2015-11-18 08:19:06.075
60	2	Create Kecamatan ID : 2	1	2015-11-18 08:19:15.59
61	3	Manage Kecamatan	1	2015-11-18 08:19:15.835
62	2	Create Kelurahan ID : 2	1	2015-11-18 08:19:30.779
63	3	Manage Kelurahan	1	2015-11-18 08:19:31.012
64	3	Manage Golongan	1	2015-11-18 08:21:18.533
65	2	Delete Golongan ID : 1	1	2015-11-18 08:21:23.529
66	3	Manage Golongan	1	2015-11-18 08:21:23.757
67	3	Manage Pejabat	1	2015-11-18 08:21:30.632
68	3	Manage Pangkat	1	2015-11-18 08:22:08.48
69	3	Manage Pejabat	1	2015-11-18 08:22:14.06
70	3	Manage Wajib Pajak	1	2015-11-18 08:23:44.573
71	3	Manage Kecamatan	1	2015-11-18 08:23:54.091
72	3	Manage Kelurahan	1	2015-11-18 08:23:57.284
73	3	Manage Pejabat	1	2015-11-18 08:25:02.503
74	3	Manage Wajib Pajak	1	2015-11-18 08:25:22.779
75	3	Manage Wajib Pajak	1	2015-11-18 08:55:29.182
76	3	View Wajib Pajak ID : 1	1	2015-11-18 08:56:03.881
77	3	Manage Bidang Usaha	1	2015-11-18 12:32:38.701
78	2	Create Bidang Usaha ID : 6	1	2015-11-18 12:33:14.391
79	3	Manage Bidang Usaha	1	2015-11-18 12:33:14.646
80	3	Manage Wajib Pajak	1	2015-11-18 12:40:08.866
\.


--
-- Name: access_log_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('access_log_seq', 80, true);


--
-- Data for Name: bidang_usaha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY bidang_usaha (id, kode, nama, created, updated) FROM stdin;
4	01	Hiburan	2015-11-17 22:40:22.04	2015-11-17 22:41:44.978
5	02	Pariwisata	2015-11-17 22:47:22.725	\N
6	03	Perikanan	2015-11-18 12:33:14.335	2015-11-18 12:33:14.335
\.


--
-- Name: bidang_usaha_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('bidang_usaha_id_seq', 6, true);


--
-- Data for Name: golongan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY golongan (id, nama, created, updated) FROM stdin;
\.


--
-- Name: golongan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('golongan_id_seq', 1, true);


--
-- Data for Name: jabatan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY jabatan (id, nama, created, updated) FROM stdin;
1	Kepala Dinas	2015-11-18 07:10:36.984	2015-11-18 07:49:49.866
\.


--
-- Name: jabatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('jabatan_id_seq', 1, true);


--
-- Data for Name: jenis_surat; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY jenis_surat (id, kode, nama, singkatan, is_official, is_self, created, updated) FROM stdin;
2	1	Surat Pemberitahuan Pajak	SPT	t	t	2015-11-17 22:59:42.082	\N
\.


--
-- Name: jenis_surat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('jenis_surat_id_seq', 2, true);


--
-- Data for Name: kecamatan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY kecamatan (id, kode, nama, created, updated) FROM stdin;
2	00	LUAR DAERAH	2015-11-18 08:19:15.545	\N
\.


--
-- Name: kecamatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('kecamatan_id_seq', 2, true);


--
-- Data for Name: kelurahan; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY kelurahan (id, kode, nama, created, updated, kecamatan_id) FROM stdin;
2	00	LUAR DAERAH	2015-11-18 08:19:30.752	\N	2
\.


--
-- Name: kelurahan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('kelurahan_id_seq', 2, true);


--
-- Data for Name: kode_rekening; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY kode_rekening (id, kode, nama, tarif_persen, tarif_dasar, created, updated, parent_id) FROM stdin;
\.


--
-- Name: kode_rekening_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('kode_rekening_id_seq', 1, false);


--
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY message (id, language, translation) FROM stdin;
1	id	Konfigurasi
2	id	Pengaturan
3	id	Field dengan
4	id	wajib diisi.
5	id	Sistem
6	id	Halaman Judul
7	id	Email Admin
8	id	Nama Perusahaan
9	id	Email Perusahaan
10	id	Izinkan pendaftaran pengguna?
11	id	Default Role untuk pengguna baru
12	id	Nama Perusahaan di Laporan
13	id	Deskripsi Perusahaan di Laporan
14	id	Alamat Perusahaan di Laporan
15	id	Bahasa
16	id	Jumlah baris default
17	id	Perusahaan
18	id	Alamat Perusahaan
19	id	Laporan
20	id	Simpan
21	id	Nama Aplikasi
22	id	Administrasi
23	id	Daftar Pengguna
24	id	Daftar Role
25	id	Daftar Operasi
26	id	Daftar Terjemah
27	id	Log Aktivitas Pengguna
28	id	Bantuan
29	id	Profile
30	id	Sunting Profil
31	id	Ganti Password
32	id	Login
33	id	Logout ({user})
36	id	Laporan Log Pengguna
37	id	SIMPATDA
38	id	Backup Database
39	id	Unggah Foto
40	id	Terjemahkan
41	id	Tampil
42	id	Operasi
43	id	Daftar Backup
44	id	Daftar Terjemahan
45	id	Terjemahan yang Hilang
46	id	Bahasa
47	id	Log Aktivitas Pengguna
48	id	Daftar Pengguna
49	id	Aktivitas Pengguna
50	id	Simpan
51	id	Buat
52	id	Daftar
53	id	Dashboard
54	id	Laporan
55	id	Desimal Mata Uang
56	id	Desimal Jumlah
57	id	Tampilkan Logo Perusahaan
58	id	Konfigurasi telah berubah.
59	id	Sistem
60	id	Perusahaan
61	id	Laporan
62	id	Pengguna
63	id	Pengguna
64	id	ID
65	id	Username
66	id	Password
67	id	Email
68	id	Nama Lengkap
69	id	Telp. 1
70	id	Telp. 2
71	id	Alamat
72	id	Status
73	id	Login Terakhir
74	id	Active Key
75	id	Role
\.


--
-- Name: message_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('message_seq', 76, true);


--
-- Data for Name: operation; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY operation (id, name, description, nama_modul, grup, urutan_ke, tampilkan_dirole) FROM stdin;
1	accessLog.index	View Access Log List	AccessLog	1	1	1
2	site.config	Setting Site Config	Settings	1	1	1
3	operation.create	Create New Operation 	Operation	1	1	1
4	operation.update	Update Operation 	Operation	1	1	1
5	operation.delete	Delete Operation 	Operation	1	1	1
6	operation.admin	Manage All Operation	Operation	1	1	1
7	operation.generate	Generate Operation 	Operation	1	1	1
8	profile.profile	View Own Profile	Profile	1	1	1
9	profile.edit	Edit Own Profile 	Profile	1	1	1
11	role.view	View Role List	Role	1	1	1
12	role.create	Create New Role 	Role	1	1	1
13	role.update	Update Role 	Role	1	1	1
14	role.delete	Delete Role 	Role	1	1	1
15	role.ajaxRevoke	Revoke User Role Via Ajax	Role	1	1	1
16	role.index	View Role List	Role	1	1	1
17	role.admin	Manage All Role	Role	1	1	1
18	role.assign	Assign User Role 	Role	1	1	1
19	role.ajaxAssign	Assign User Role Via Ajax 	Role	1	1	1
20	user.view	View User 	User	2	1	1
21	user.create	Create New User 	User	2	1	1
22	user.update	Update User 	User	2	1	1
23	user.delete	Delete User 	User	2	1	1
24	user.index	View All User List	User	2	1	1
25	report.user	View User Log List Report	Report	1	1	1
26	operation.generateAll	Operation GenerateAll	Operation	1	1	1
27	profile.changePhoto	Profile ChangePhoto	Profile	1	1	1
28	report.userLog	Report UserLog	Report	1	1	1
29	report.userLogForm	Report UserLogForm	Report	1	1	1
30	backup.default.create	Backup Default Create	Backup	1	1	1
31	backup.default.delete	Backup Default Delete	Backup	1	1	1
32	backup.default.download	Backup Default Download	Backup	1	1	1
33	backup.default.index	Backup Default Index	Backup	1	1	1
34	backup.default.restore	Backup Default Restore	Backup	1	1	1
35	backup.default.upload	Backup Default Upload	Backup	1	1	1
36	translate.edit.create	Translate Edit Create	Translate	1	1	1
37	translate.edit.update	Translate Edit Update	Translate	1	1	1
38	translate.edit.delete	Translate Edit Delete	Translate	1	1	1
39	translate.edit.index	Translate Edit Index	Translate	1	1	1
40	translate.edit.missing	Translate Edit Missing	Translate	1	1	1
41	translate.edit.missingdelete	Translate Edit Missingdelete	Translate	1	1	1
42	translate.translate.index	Translate Translate Index	Translate	1	1	1
43	accessLog.download	AccessLog Download	AccessLog	1	1	1
44	site.index	Site Index	Site	1	1	1
45	jReport.userList	JReport UserList	JReport	1	1	1
46	jReport.userActivityList	JReport UserActivityList	JReport	1	1	1
49	bidangUsaha.create	BidangUsaha Create	BidangUsaha	2	1	1
50	bidangUsaha.update	BidangUsaha Update	BidangUsaha	2	1	1
51	bidangUsaha.delete	BidangUsaha Delete	BidangUsaha	2	1	1
52	bidangUsaha.index	BidangUsaha Index	BidangUsaha	2	1	1
54	golongan.create	Golongan Create	Golongan	2	1	1
55	golongan.update	Golongan Update	Golongan	2	1	1
56	golongan.delete	Golongan Delete	Golongan	2	1	1
59	jabatan.create	Jabatan Create	Jabatan	2	1	1
60	jabatan.update	Jabatan Update	Jabatan	2	1	1
61	jabatan.delete	Jabatan Delete	Jabatan	2	1	1
62	jabatan.index	Jabatan Index	Jabatan	2	1	1
63	jenisSurat.view	JenisSurat View	JenisSurat	2	1	1
64	jenisSurat.create	JenisSurat Create	JenisSurat	2	1	1
65	jenisSurat.update	JenisSurat Update	JenisSurat	2	1	1
66	jenisSurat.delete	JenisSurat Delete	JenisSurat	2	1	1
67	jenisSurat.index	JenisSurat Index	JenisSurat	2	1	1
69	kecamatan.create	Kecamatan Create	Kecamatan	2	1	1
70	kecamatan.update	Kecamatan Update	Kecamatan	2	1	1
71	kecamatan.delete	Kecamatan Delete	Kecamatan	2	1	1
72	kecamatan.index	Kecamatan Index	Kecamatan	2	1	1
74	kelurahan.create	Kelurahan Create	Kelurahan	2	1	1
75	kelurahan.update	Kelurahan Update	Kelurahan	2	1	1
76	kelurahan.delete	Kelurahan Delete	Kelurahan	2	1	1
77	kelurahan.index	Kelurahan Index	Kelurahan	2	1	1
79	kodeRekening.create	KodeRekening Create	KodeRekening	2	1	1
80	kodeRekening.update	KodeRekening Update	KodeRekening	2	1	1
81	kodeRekening.delete	KodeRekening Delete	KodeRekening	2	1	1
82	kodeRekening.index	KodeRekening Index	KodeRekening	2	1	1
84	pangkat.create	Pangkat Create	Pangkat	2	1	1
85	pangkat.update	Pangkat Update	Pangkat	2	1	1
86	pangkat.delete	Pangkat Delete	Pangkat	2	1	1
87	pangkat.index	Pangkat Index	Pangkat	2	1	1
88	pejabat.view	Pejabat View	Pejabat	2	1	1
89	pejabat.create	Pejabat Create	Pejabat	2	1	1
90	pejabat.update	Pejabat Update	Pejabat	2	1	1
91	pejabat.delete	Pejabat Delete	Pejabat	2	1	1
92	pejabat.index	Pejabat Index	Pejabat	2	1	1
94	wajibPajak.view	WajibPajak View	WajibPajak	2	1	1
95	wajibPajak.create	WajibPajak Create	WajibPajak	2	1	1
96	wajibPajak.update	WajibPajak Update	WajibPajak	2	1	1
10	profile.changePassword	Change Own Password	Profile	1	1	1
57	golongan.index	Golongan Index	Golongan	2	1	1
78	kodeRekening.view	KodeRekening View	KodeRekening	2	1	1
97	wajibPajak.delete	WajibPajak Delete	WajibPajak	2	1	1
98	wajibPajak.index	WajibPajak Index	WajibPajak	2	1	1
\.


--
-- Name: operation_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('operation_seq', 98, true);


--
-- Data for Name: pangkat; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY pangkat (id, nama, created, updated) FROM stdin;
1	Eselon 1	2015-11-18 07:50:09.616	\N
\.


--
-- Name: pangkat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('pangkat_id_seq', 1, true);


--
-- Data for Name: pejabat; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY pejabat (id, kode, nama, nip, status, created, updated, golongan_id, jabatan_id, pangkat_id) FROM stdin;
\.


--
-- Name: pejabat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('pejabat_id_seq', 1, true);


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY role (id, name) FROM stdin;
1	Super User
\.


--
-- Data for Name: role_access; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY role_access (role_id, operation_id) FROM stdin;
1	43
1	1
1	30
1	31
1	32
1	33
1	34
1	35
1	46
1	45
1	6
1	3
1	5
1	7
1	26
1	4
1	10
1	27
1	9
1	8
1	25
1	28
1	29
1	17
1	19
1	15
1	18
1	12
1	14
1	16
1	13
1	11
1	2
1	44
1	36
1	38
1	39
1	40
1	41
1	37
1	42
1	49
1	51
1	52
1	50
1	54
1	56
1	57
1	55
1	59
1	61
1	62
1	60
1	64
1	66
1	67
1	65
1	63
1	69
1	71
1	72
1	70
1	74
1	76
1	77
1	75
1	79
1	81
1	82
1	80
1	78
1	84
1	86
1	87
1	85
1	89
1	91
1	92
1	90
1	88
1	21
1	23
1	24
1	22
1	20
1	95
1	97
1	98
1	96
1	94
\.


--
-- Name: role_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('role_seq', 1, false);


--
-- Data for Name: sourcemessage; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY sourcemessage (id, category, message) FROM stdin;
1	trans	Config
2	trans	Settings
3	trans	Fields with
4	trans	are required.
5	trans	Sistem
6	trans	Page Title
7	trans	Admin Email
8	trans	Company Name
9	trans	Company Email
10	trans	Allow user registration?
11	trans	New User Default Role
12	trans	Company Name Report
13	trans	Company Description Report
14	trans	Company Address Report
15	trans	Language
16	trans	Default Page Size
17	trans	Perusahaan
18	trans	Company Address
19	trans	Laporan
20	trans	Save
21	trans	Application Name Title
22	trans	Administration
23	trans	Manage User
24	trans	Manage Role
25	trans	Manage Operation
26	trans	Manage Translation
27	trans	User Access Log
28	trans	Help
29	trans	Profile
30	trans	Edit Profile
31	trans	Change Password
32	trans	Login
33	trans	Logout ({user})
36	trans	User Log Report
37	trans	SIMPATDA
38	trans	Manage Backup DB
39	trans	Upload Photo
40	trans	Translate
41	trans	Tampil
42	trans	Operations
43	trans	List Backup
44	trans	List Messages
45	trans	Missing Translations
46	trans	Language
47	trans	User Log
48	trans	User List
49	trans	User Actvity
50	trans	Simpan
51	trans	Create
52	trans	Manage
53	trans	Dashboard
54	trans	Report
55	trans	Currency Precision
56	trans	Quantity Precision
57	trans	Display Company Logo
58	trans	Configuration has been changed.
59	trans	System
60	trans	Company
61	trans	Reports
62	trans	User
63	trans	Users
64	trans	ID
65	trans	Username
66	trans	Password
67	trans	Email
68	trans	Fullname
69	trans	Phone 1
70	trans	Phone 2
71	trans	Address
72	trans	Status
73	trans	Last Login
74	trans	Activkey
75	trans	Role
76	trans	Don't have an account?
77	trans	User Login.
78	trans	Please provide your details
79	trans	Remember me next time
80	trans	Forgot Password
81	trans	Error
82	trans	Sorry, an error has occured! Why not try going back to the <a href="{url}">home page</a> or perhaps try following!
83	trans	Back to Dashboard
89	trans	Home
90	trans	Access Log List
91	trans	Type
92	trans	Activity
93	trans	Time
95	trans	Roles
96	trans	Name
97	trans	Update
98	trans	View
99	trans	Master
100	trans	Update Role ID : 
101	trans	You do not have sufficient permissions to access this page.
102	trans	View Role ID : 
103	trans	Delete
104	trans	Assign User
105	trans	Revoke
106	trans	View Profile
107	trans	Change Photo
108	trans	Log Akses
109	trans	Download LOG
110	trans	Data Master
111	trans	Bidang Usaha
112	trans	Golongan
113	trans	Jabatan
114	trans	Jenis Surat
115	trans	Kecamatan
116	trans	Kelurahan
117	trans	Kode Rekening
118	trans	Pangkat
119	trans	Pejabat
120	trans	Wajib Pajak
121	trans	Generate All
122	trans	Description
123	trans	Nama Modul
124	trans	Grup
125	trans	Urutan Ke
126	trans	Tampilkan Dirole
127	trans	Generate
128	trans	Operation
129	trans	Update Operation ID : 
132	trans	Kode
133	trans	Nama
134	trans	Created
135	trans	Updated
130	trans	Manage Bidang Usaha
131	trans	Bidang Usaha
136	trans	Manage Jenis Surat
137	trans	Singkatan
138	trans	Is Official
139	trans	Is Self
140	trans	Delete Operation ID : 
141	trans	Create Bidang Usaha ID : 
142	trans	Update Bidang Usaha ID : 
143	trans	Delete Bidang Usaha ID : 
144	trans	Create Jenis Surat ID : 
145	trans	View Jenis Surat ID : {id}
146	trans	Are you sure you want to delete this item?
147	trans	User Logs Report
148	trans	Actions
149	trans	MASTER USER REPORT
150	trans	Master User
151	trans	--Semua Status--
152	trans	Aktif Status
153	trans	--Semua Role--
154	trans	Preview
155	trans	Export to PDF
156	trans	Export to Excel
157	trans	By User Name
158	trans	Caught Exception: {ex}
159	trans	Manage Golongan
160	trans	Create Golongan ID : 
161	trans	Manage Jabatan
162	trans	Create Jabatan ID : 
163	trans	Manage Kecamatan
164	trans	Manage Kelurahan
165	trans	Manage Kode Rekening
166	trans	Tarif Persen
167	trans	Tarif Dasar
168	trans	Parent
169	trans	Manage Pangkat
170	trans	Manage Pejabat
171	trans	Nip
172	trans	Manage Wajib Pajak
173	trans	Jenis
174	trans	Nomor
175	trans	Alamat
176	trans	Kabupaten
177	trans	Telepon
178	trans	Tanggal Tutup
179	trans	Kodepos
180	trans	Id Jenis
181	trans	Id Nomor
182	trans	Tanggal Lahir
183	trans	Kk Nomor
184	trans	Kk Tanggal
185	trans	Pekerjaan
186	trans	Alamat Pekerjaan
187	trans	Bu Nama
188	trans	Bu Alamat
189	trans	Bu Kabupaten
190	trans	Bu Kecamatan
191	trans	Bu Kelurahan
192	trans	Bu Telepon
193	trans	Bu Kodepos
194	trans	Warga Negara
195	trans	Create Kecamatan ID : 
196	trans	Create Kelurahan ID : 
197	trans	Update Jabatan ID : 
198	trans	Create Pangkat ID : 
199	trans	Create Pejabat ID : 
200	trans	View Pejabat ID : {id}
201	trans	Active
202	trans	Not Active
203	trans	Delete Pejabat ID : 
204	trans	Banned
205	trans	Delete Kecamatan ID : 
206	trans	Delete Golongan ID : 
207	trans	View Wajib Pajak ID : {id}
208	trans	Not Set
209	trans	- Pilih Kecamatan -
210	trans	- Pilih Kelurahan -
211	trans	PAJAK
212	trans	RETRIBUSI
\.


--
-- Name: sourcemessage_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('sourcemessage_seq', 212, true);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY "user" (id, username, image, password, email, fullname, phone_1, phone_2, address, status, last_login, activkey, role_id) FROM stdin;
1	admin	eb775e4610fe263212b228cb1290253c8dbe66ac.jpg	d033e22ae348aeb5660fc2140aec35850c4da997	admin@taneweb.com	Administrator PG	081888888	\N	Jl. Jambu Klutuk	1	2015-11-18 12:30:26	\N	1
\.


--
-- Name: user_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('user_seq', 2, true);


--
-- Data for Name: wajib_pajak; Type: TABLE DATA; Schema: public; Owner: simpatdadb
--

COPY wajib_pajak (id, jenis, golongan, nomor, nama, alamat, kabupaten, kecamatan, kelurahan, telepon, status, tanggal_tutup, kodepos, id_jenis, id_nomor, tanggal_lahir, kk_nomor, kk_tanggal, pekerjaan, alamat_pekerjaan, bu_nama, bu_alamat, bu_kabupaten, bu_kecamatan, bu_kelurahan, bu_telepon, bu_kodepos, kelurahan_id, kecamatan_id, bidang_usaha_id, warga_negara, created, updated) FROM stdin;
1	p	1	12	tet	\N	a	s	d	123	t	\N	12	\N	\N	1988-06-28	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	WNI	\N	\N
\.


--
-- Name: wajib_pajak_id_seq; Type: SEQUENCE SET; Schema: public; Owner: simpatdadb
--

SELECT pg_catalog.setval('wajib_pajak_id_seq', 1, true);


--
-- Name: access_log_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY access_log
    ADD CONSTRAINT access_log_pkey PRIMARY KEY (id);


--
-- Name: bidang_usaha_PK; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bidang_usaha
    ADD CONSTRAINT "bidang_usaha_PK" PRIMARY KEY (id);


--
-- Name: golongan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY golongan
    ADD CONSTRAINT "golongan_PK" PRIMARY KEY (id);


--
-- Name: jabatan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY jabatan
    ADD CONSTRAINT "jabatan_PK" PRIMARY KEY (id);


--
-- Name: jenis_surat_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY jenis_surat
    ADD CONSTRAINT "jenis_surat_PK" PRIMARY KEY (id);


--
-- Name: kecamatan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY kecamatan
    ADD CONSTRAINT "kecamatan_PK" PRIMARY KEY (id);


--
-- Name: kelurahan_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY kelurahan
    ADD CONSTRAINT "kelurahan_PK" PRIMARY KEY (id);


--
-- Name: kode_rekening_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY kode_rekening
    ADD CONSTRAINT "kode_rekening_PK" PRIMARY KEY (id);


--
-- Name: message_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY message
    ADD CONSTRAINT message_pkey PRIMARY KEY (id);


--
-- Name: operation_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY operation
    ADD CONSTRAINT operation_pkey PRIMARY KEY (id);


--
-- Name: pangkat_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY pangkat
    ADD CONSTRAINT "pangkat_PK" PRIMARY KEY (id);


--
-- Name: pejabat_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_PK" PRIMARY KEY (id);


--
-- Name: role_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: sourcemessage_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY sourcemessage
    ADD CONSTRAINT sourcemessage_pkey PRIMARY KEY (id);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: wajib_pajak_PK; Type: CONSTRAINT; Schema: public; Owner: simpatdadb; Tablespace: 
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_PK" PRIMARY KEY (id);


--
-- Name: access_log_fk_user; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY access_log
    ADD CONSTRAINT access_log_fk_user FOREIGN KEY (user_id) REFERENCES "user"(id) ON DELETE CASCADE;


--
-- Name: kelurahan_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kelurahan
    ADD CONSTRAINT "kelurahan_FK_1" FOREIGN KEY (kecamatan_id) REFERENCES kecamatan(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: kode_rekening_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY kode_rekening
    ADD CONSTRAINT "kode_rekening_FK_1" FOREIGN KEY (parent_id) REFERENCES kode_rekening(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: message_fk_sourcemessage; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY message
    ADD CONSTRAINT message_fk_sourcemessage FOREIGN KEY (id) REFERENCES sourcemessage(id) ON DELETE CASCADE;


--
-- Name: pejabat_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_FK_1" FOREIGN KEY (jabatan_id) REFERENCES jabatan(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pejabat_FK_2; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_FK_2" FOREIGN KEY (golongan_id) REFERENCES golongan(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pejabat_FK_3; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY pejabat
    ADD CONSTRAINT "pejabat_FK_3" FOREIGN KEY (pangkat_id) REFERENCES pangkat(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: role_access_fk_operation; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY role_access
    ADD CONSTRAINT role_access_fk_operation FOREIGN KEY (operation_id) REFERENCES operation(id);


--
-- Name: role_access_fk_role; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY role_access
    ADD CONSTRAINT role_access_fk_role FOREIGN KEY (role_id) REFERENCES role(id);


--
-- Name: user_fk_role; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_fk_role FOREIGN KEY (role_id) REFERENCES role(id);


--
-- Name: wajib_pajak_FK_1; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_FK_1" FOREIGN KEY (kecamatan_id) REFERENCES kecamatan(id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- Name: wajib_pajak_FK_2; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_FK_2" FOREIGN KEY (kelurahan_id) REFERENCES kelurahan(id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- Name: wajib_pajak_FK_3; Type: FK CONSTRAINT; Schema: public; Owner: simpatdadb
--

ALTER TABLE ONLY wajib_pajak
    ADD CONSTRAINT "wajib_pajak_FK_3" FOREIGN KEY (bidang_usaha_id) REFERENCES bidang_usaha(id) ON UPDATE SET NULL ON DELETE SET NULL;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

